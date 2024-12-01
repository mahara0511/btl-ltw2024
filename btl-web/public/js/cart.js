$(document).ready(function () {
  // Update item quantity

  const modal = $('#Modal_alert')

  function toggleModal() {
    let title = modal.find('#ModalAlertLabel')[0].innerHTML
    if (title) {
      if (modal.hasClass(title)) {
        modal.removeClass(title)
      } else {
        modal.addClass(title)
      }
    }
    if (modal.hasClass('show')) {
      modal.removeClass('show').addClass('fade')
    } else {
      modal.removeClass('fade').addClass('show')
    }
  }

  function showModal(modalItem, title, content) {
    modalItem.find('#ModalAlertLabel').text(title)
    modalItem.find('#modal_message').text(content)
    toggleModal()
  }

  $('#Modal_alert button').on('click', toggleModal)

  // Store the initial quantity value
  let originalQuantity = 0

  // On page load, store the original quantity value for each row
  $('.qty').each(function () {
    originalQuantity = $(this).val()
    $(this).data('original', originalQuantity) // Store the original value in the data attribute
  })

  $('.update').click(function () {
    const product_id = $(this).attr('update_id')
    const quantity = $(this).closest('tr').find('.qty').val() // Get the updated quantity
    const $quantityInput = $(this).closest('tr').find('.qty')
    const newQuantity = $quantityInput.val() // Get the updated quantity
    const oldQuantity = $quantityInput.data('original') // Get the stored original quantity

    if (newQuantity !== oldQuantity) {
      // If the quantity has changed
      if (quantity > 0) {
        $.ajax({
          url: 'index.php', // Endpoint for handling cart actions
          type: 'POST',
          data: {
            cart_action: 'updateItemfromCart',
            pid: product_id,
            qty: quantity,
          },
          success: function (response) {
            // Show success modal with message
            // Check if modal is visible (has the 'show' class)
            //   $('#ModalAlertLabel').text('Notification')
            //   $('#modal_message').text('Updated quantity successfully!')
            //   toggleModal()
            showModal(modal, 'Notification', 'Updated quantity successfully!')
            $('#Modal_alert button').on('click', function () {
              if (modal.hasClass('fade')) {
                location.reload() // Reload to update the cart
              }
            })
          },
          error: function () {
            alert('An error occurred while updating the cart.')
          },
        })
      } else {
        alert('Quantity must be at least 1.')
      }
    } else {
      // If quantity has not changed
      // alert('Quantity is the same, no update required.')
      showModal(modal, 'Alert', 'Quantity is the same, no update required.')
    }
  })

  // Remove item from cart
  $('.remove').click(function () {
    const product_id = $(this).attr('remove_id')
    if (confirm('Are you sure you want to remove this item from the cart?')) {
      $.ajax({
        url: 'index.php', // Endpoint for handling cart actions
        type: 'POST',
        data: {
          cart_action: 'removeItemfromCart',
          pid: product_id,
        },
        success: function (response) {
          // Show success modal with message
          //   $('#ModalAlertLabel').text('Notification')
          //   $('#modal_message').text('Removed item successfully!')
          //   toggleModal()

          showModal(modal, 'Notification', 'Removed item successfully!')

          $('#Modal_alert button').on('click', function () {
            if (modal.hasClass('fade')) {
              location.reload() // Reload to update the cart
            }
          })
        },
        error: function () {
          alert('An error occurred while removing the item from the cart.')
        },
      })
    }
  })
})
