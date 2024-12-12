document.addEventListener('DOMContentLoaded', () => {
  const table = document.querySelector('.responsive-table')

  // Modal HTML to be inserted into the document
  const modalHtml = `
        <div id="orderDetailsModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <div id="orderDetailsContent"></div>
            </div>
        </div>
    `
  document.body.insertAdjacentHTML('beforeend', modalHtml)

  // Modal elements
  const modal = document.getElementById('orderDetailsModal')
  const modalContent = document.getElementById('orderDetailsContent')
  const closeButton = document.querySelector('.close-button')

  // Close modal when clicking close button or outside the modal
  closeButton.addEventListener('click', closeModal)
  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      closeModal()
    }
  })

  // Function to close modal
  function closeModal() {
    modal.style.display = 'none'
  }

  // Add click event to table rows
  table.addEventListener('click', async (event) => {
    const row = event.target.closest('tr')
    if (!row) return

    const orderId = row.dataset.orderId

    try {
      const response = await fetch(`/orders/${orderId}`)

      if (!response.ok) {
        throw new Error('Failed to fetch order details')
      }

      const orderDetails = await response.json()

      // Generate HTML for order details
      const detailsHtml = `
                <h2>Order Details #${orderDetails.order_id}</h2>
                <div class="order-info">
                    <p><strong>Customer:</strong> ${orderDetails.f_name}</p>
                    <p><strong>Email:</strong> ${orderDetails.email}</p>
                    <p><strong>Order Date:</strong> ${
                      orderDetails.order_date
                    }</p>
                    <p><strong>Shipping Address:</strong> ${
                      orderDetails.address
                    }, ${orderDetails.district}, ${orderDetails.province}</p>
                    <p><strong>Payment Method:</strong> ${
                      orderDetails.cardname
                    } (${orderDetails.cardnumber.slice(-4)})</p>
                    <p><strong>Total Amount:</strong> $${
                      orderDetails.total_amt
                    }</p>
                </div>

                <h3>Products</h3>
                <table class="order-products">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${orderDetails.products
                          .map(
                            (product) => `
                            <tr onclick="window.location.href='/store?product_id=${
                              product.product_id
                            }'">
                              <td>
                                  <img src="public/product_images/${
                                    product.product_image
                                  }" 
                                      alt="${product.product_title}" 
                                      class="product-thumbnail">
                                  ${product.product_title}
                              </td>
                              <td data-label="Quantity">${product.qty}</td>
                              <td data-label="Price">$${parseFloat(
                                product.product_price
                              ).toFixed(2)}</td>
                              <td data-label="Subtotal">$${parseFloat(
                                product.amt
                              ).toFixed(2)}</td>
                          </tr>
                        `
                          )
                          .join('')}
                    </tbody>
                </table>
            `

      // Display details in modal
      modalContent.innerHTML = detailsHtml
      modal.style.display = 'block'
    } catch (error) {
      console.error('Error fetching order details:', error)
      alert('Failed to fetch order details. Please try again.')
    }
  })
})
