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

  // ------------------------------ MODAL ------------------------------

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
  // Add-to-cart functionality
  $(document).on('click', '.add-to-cart-btn', function (event) {
    event.preventDefault()
    const productId = $(this).attr('pid')
    const quantity =
      $(this).closest('.product').find('#quantity-input').val() || 1 // Default to 1 if not found

    $.ajax({
      url: '/view_cart',
      method: 'POST',
      data: {
        cart_action: 'addToCart',
        pid: productId,
        qty: quantity,
      },
      success: function (response) {
        let status = 'Error'
        switch (response.status) {
          case 'success':
            status = 'Notification'
            break
          case 'warning':
            status = 'Alert'
            break
          default:
            status = 'Error'
            break
        }

        showModal(
          modal,
          status,
          response.message || 'An error occurred while adding to cart.'
        )

        $('#Modal_alert button').on('click', function () {
          if (modal.hasClass('fade')) {
            if (status == 'Notification') location.reload() // Reload to update the cart
          }
        })
      },
      error: function () {
        showModal(modal, 'Error', 'An error occurred while updating the cart.')
      },
    })
  })

  // Reply Button Functionality
  document.querySelectorAll('.reply-btn').forEach((button) => {
    button.addEventListener('click', function () {
      const commentId = this.getAttribute('data-comment-id')
      const replyForm = document.getElementById('reply-form-' + commentId)

      // Close any other open reply forms
      document.querySelectorAll('.reply-form').forEach((form) => {
        if (form.id !== 'reply-form-' + commentId) {
          form.style.display = 'none'
        }
      })

      // Toggle this reply form
      replyForm.style.display =
        replyForm.style.display === 'none' ? 'block' : 'none'
    })
  })

  // Close Reply Button Functionality
  document.addEventListener('click', function (event) {
    if (event.target.classList.contains('close-reply-btn')) {
      const replyForm = event.target.closest('.reply-form')
      if (replyForm) {
        replyForm.style.display = 'none'
      }
    }
  })

  // Handle "See replies" button click
  document.querySelectorAll('.see-replies-btn').forEach((button) => {
    button.addEventListener('click', function () {
      const commentId = this.getAttribute('data-comment-id')
      const nestedReplies = document.getElementById(
        'nested-replies-' + commentId
      )
      const numReplies = this.getAttribute('data-count-replies')
      if (nestedReplies.style.display === 'none') {
        nestedReplies.style.display = 'block'
        this.textContent = 'Hide replies'
      } else {
        nestedReplies.style.display = 'none'
        this.textContent = 'See replies (' + numReplies + ')'
      }
    })
  })

  // Add Comment
  document
    .querySelector('.new-comment-form form')
    .addEventListener('submit', function (event) {
      event.preventDefault() // Prevent the form from submitting the traditional way

      const form = event.target
      const formData = new FormData(form)
      const content = formData.get('content')
      const productId = formData.get('p_id')

      // Make the AJAX request to add a new comment
      fetch('/store?action=addComment', {
        method: 'POST',
        body: new URLSearchParams({
          p_id: productId,
          content: content,
        }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
          }
          return response.json()
        })
        .then((data) => {
          const messageElement = document.querySelector(
            '.new-comment-form .comment-message'
          )
          if (data.success) {
            location.reload()
            form.reset()
          } else {
            // Failure: Show the error message
            if (data.message === 'Not logged in') {
              messageElement.innerHTML = `You must login to comment. <a href='login-form.php'>Log in here</a>`
            } else {
              messageElement.textContent = data.message
            }
            messageElement.style.color = 'red'
          }
        })
        .catch((error) => {
          alert('An error occurred while adding your comment.')
        })
    })

  // Handle submit of reply form
  document
    .querySelectorAll('.reply-form .reply-form-submit')
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        event.preventDefault() // Prevent the form from submitting the traditional way
        const form = event.target
        const formData = new FormData(form)
        const content = formData.get('content')
        const parentId = formData.get('parent_id')
        const productId = formData.get('p_id')

        console.log(form)
        // Make the AJAX request to add a reply
        fetch('/store?action=addComment', {
          method: 'POST',
          body: new URLSearchParams({
            p_id: productId,
            content: content,
            parent_id: parentId,
          }),
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`)
            }
            return response.json()
          })
          .then((data) => {
            const messageElement = form.querySelector('.comment-message')
            if (data.success) {
              location.reload()
              form.reset()
            } else {
              if (data.message === 'Not logged in') {
                messageElement.innerHTML = `You must login to reply. <a href='login-form.php'>Log in here</a>`
              } else {
                messageElement.textContent = data.message
              }
              messageElement.style.color = 'red'
            }
          })
          .catch((error) => {
            alert('An error occurred while posting your reply.')
          })
      })
    })

  // Edit Comment
  document.querySelectorAll('.edit-comment').forEach((editLink) => {
    editLink.addEventListener('click', function (event) {
      event.preventDefault()
      const commentId = this.getAttribute('data-comment-id')
      const commentBody =
        this.closest('.comment').querySelector('.comment-body')
      const currentContent = commentBody.textContent.trim()

      // Replace text with textarea
      commentBody.innerHTML = `
            <span class="comment-message"></span>
            <textarea class="edit-comment-textarea">${currentContent}</textarea>
            <div class="edit-comment-actions">
                <button class="save-edit-btn btn btn-primary" data-comment-id="${commentId}">Save</button>
                <button class="cancel-edit-btn btn btn-primary">Cancel</button>
            </div>
        `

      // Save Edit Button
      const saveBtn = commentBody.querySelector('.save-edit-btn')
      saveBtn.addEventListener('click', function () {
        const newContent = commentBody.querySelector('textarea').value.trim()

        // AJAX call to update comment
        fetch('/store?action=editComment', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            commentId: commentId,
            content: newContent,
          }),
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`)
            }
            return response.json()
          })
          .then((data) => {
            if (data.success) {
              commentBody.innerHTML = newContent // Update the comment text
            } else {
              const messageElement =
                commentBody.querySelector('.comment-message')
              messageElement.textContent =
                data.message || 'Failed to update comment'
              messageElement.style.color = 'red'
            }
          })
          .catch((error) => {
            console.error('Error:', error)
            alert('An error occurred while updating the comment')
          })
      })

      // Cancel Edit Button
      const cancelBtn = commentBody.querySelector('.cancel-edit-btn')
      cancelBtn.addEventListener('click', function () {
        commentBody.innerHTML = currentContent
      })
    })
  })

  // Delete Comment
  document.querySelectorAll('.delete-comment').forEach((deleteLink) => {
    deleteLink.addEventListener('click', function (event) {
      event.preventDefault()
      const commentId = this.getAttribute('data-comment-id')

      if (confirm('Are you sure you want to delete this comment?')) {
        fetch('/store?action=deleteComment', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            commentId: commentId,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              const commentElement = this.closest('.comment')
              commentElement.remove()
            } else {
              alert('Failed to delete comment')
            }
          })
      }
    })
  })
})
