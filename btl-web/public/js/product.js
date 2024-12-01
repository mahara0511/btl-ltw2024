document.addEventListener('DOMContentLoaded', function () {
  // Flex slider for product images
  // Initialize Slick for thumbnails
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: 0,
    vertical: true,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          vertical: false,
          arrows: false,
          dots: true,
        },
      },
    ],
  })

  // Handle arrow clicks to update the main image
  $('#product-imgs').on('click', function () {
    const mainImage = document.querySelector('#product-main-img img')
    const thumbnailImage = document.querySelector(
      '#product-imgs .slick-current img'
    )
    mainImage.src = thumbnailImage.src // Update the main image source
    mainImage.style.transform = thumbnailImage.style.transform // Apply the transform style
  })
  // Handle dot clicks in responsive mode
  $('#product-imgs').on('click', function () {
    const mainImage = document.querySelector('#product-main-img img')
    const thumbnailImage = document.querySelector(
      '#product-imgs .slick-current img'
    )
    mainImage.src = thumbnailImage.src // Update the main image source
    mainImage.style.transform = thumbnailImage.style.transform // Apply the transform style
  })
  // Handle slider drag or slide change to update the main image
  $('#product-imgs').on('afterChange', function () {
    const mainImage = document.querySelector('#product-main-img img')
    const thumbnailImage = document.querySelector(
      '#product-imgs .slick-current img'
    )
    mainImage.src = thumbnailImage.src // Update the main image source
    mainImage.style.transform = thumbnailImage.style.transform // Apply the transform style
  })

  // Handle quantity input
  const quantityInput = document.getElementById('quantity-input')
  document.querySelector('.qty-down').addEventListener('click', () => {
    if (quantityInput.value > 1) {
      quantityInput.value--
    }
  })
  document.querySelector('.qty-up').addEventListener('click', () => {
    quantityInput.value++
  })

  // Handle add-to-cart functionality

  $(document).on(
    'click',
    '.btn-group .add-to-cart-btn#product',
    function (event) {
      event.preventDefault()
      const productId = $(this).attr('pid')
      const quantity = parseInt(quantityInput.value)

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

      $.ajax({
        url: 'index.php',
        method: 'POST',
        data: {
          cart_action: 'addToCart',
          pid: productId,
          qty: quantity,
        },
        success: function (response) {
          // console.log(response)

          // alert('Product is added to cart successfully.')
          // location.reload() // Reload to update the cart

          showModal(
            modal,
            'Notification',
            'Product is added to cart successfully.'
          )
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
    }
  )
})
