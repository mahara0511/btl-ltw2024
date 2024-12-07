var originProducts = []
var productsToFilter = []

$(document).ready(function () {
  // Toggle categories
  $('.toggle-category').on('click', function () {
    $('.category-list').slideToggle(500)
    $('.toggle-category i').toggleClass('fa-arrow-down fa-arrow-up')
  })

  // Toggle brands
  $('.toggle-brand').on('click', function () {
    $('.brand-list').slideToggle(500)
    $('.toggle-brand i').toggleClass('fa-arrow-down fa-arrow-up')
  })

  // Toggle get top sellings
  $('.toggle-get_product_home').on('click', function () {
    $('#get_product_home>.product-widget').slideToggle(500)
    $('.toggle-get_product_home i').toggleClass('fa-arrow-down fa-arrow-up')
  })

  // Handle category button click
  $('.category').click(function (event) {
    event.preventDefault() // Prevent the default link behavior
    const categoryId = $(this).attr('cid')
    originProducts = []
    productsToFilter = []
    $.ajax({
      url: '/store?action=view_category',
      method: 'GET',
      data: { cid: categoryId },
      success: function (response) {
        const newStoreContent = $(response).find('#store').html()
        $('#store').html(newStoreContent)
        window.history.pushState(
          null,
          null,
          '/store?action=view_category&cid=' + categoryId
        )
        renderProductsList()
        handleAddToCartBtn()
      },
      error: function (xhr, status, error) {
        console.error('Error fetching category:', error)
      },
    })
  })

  // Handle category button click
  $('.selectBrand').click(function (event) {
    event.preventDefault() // Prevent the default link behavior
    const brandId = $(this).attr('bid')
    originProducts = []
    productsToFilter = []
    $.ajax({
      url: '/store?action=view_brand',
      method: 'GET',
      data: { bid: brandId },
      success: function (response) {
        const newStoreContent = $(response).find('#store').html()
        $('#store').html(newStoreContent)
        window.history.pushState(
          null,
          null,
          '/store?action=view_brand&bid=' + brandId
        )
        renderProductsList()
        handleAddToCartBtn()
      },
      error: function (xhr, status, error) {
        console.error('Error fetching category:', error)
      },
    })
  })
  renderProductsList()
  handleAddToCartBtn()
})

$(window).on('popstate', function () {
  let urlParams = new URLSearchParams(window.location.search)
  let categoryId = urlParams.get('cid')
  let brandId = urlParams.get('bid')

  // Determine which data to load based on URL parameters
  if (categoryId) {
    loadData('view_category', { cid: categoryId })
  } else if (brandId) {
    loadData('view_brand', { bid: brandId })
  } else {
    loadData('view') // Default content
  }
})

// Load data function for category or brand
function loadData(action, params) {
  $.ajax({
    url: `/store?action=${action}`,
    method: 'GET',
    data: params,
    success: function (response) {
      const newStoreContent = $(response).find('#store').html()
      $('#store').html(newStoreContent)
    },
    error: function (xhr, status, error) {
      console.error(`Error fetching ${action}:`, error)
    },
  })
}

// Load the default content (e.g., all products)
function loadDefaultContent() {
  $.ajax({
    url: '/store?action=view', // or whatever action loads the main store view
    method: 'GET',
    success: function (response) {
      const newStoreContent = $(response).find('#store').html()
      $('#store').html(newStoreContent)
    },
    error: function (xhr, status, error) {
      console.error('Error fetching default content:', error)
    },
  })
}

function handleAddToCartBtn() {
  $(document).on('click', '.add-to-cart button', function (event) {
    event.preventDefault()
    const productId = $(this).attr('pid')
    // console.log(productId)

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

    // Check if the user is logged in
    const isLoggedIn = !!localStorage.getItem('userSessionId') // Replace with your session check logic
    if (isLoggedIn) {
      $.ajax({
        url: '/view_cart',
        method: 'POST',
        data: {
          cart_action: 'addToCart',
          pid: productId,
          qty: 1,
        },
        success: function (response) {
          // Show success modal with message
          var status = 'Error'
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
            response.message || 'An error occurred while updating the cart.'
          )
          $('#Modal_alert button').on('click', function () {
            if (modal.hasClass('fade')) {
              if (status == 'Notification') location.reload() // Reload to update the cart
            }
          })
        },
        error: function () {
          showModal(
            modal,
            'Error',
            'An error occurred while updating the cart.'
          )
        },
      })
    } else {
      // User is not logged in, save to local storage
      let cart = JSON.parse(localStorage.getItem('cart')) || []
      const cartItem = { pid: productId, qty: 1 }

      // Check if the item is already in the cart
      const existingItem = cart.find((item) => item.pid === productId)
      if (existingItem) {
        showModal(modal, 'Alert', 'Product is already added into the cart!')
        $('#Modal_alert button').on('click', function () {
          if (modal.hasClass('fade')) {
            location.reload() // Reload to update the cart
          }
        })
      } else {
        cart.push(cartItem) // Add new item
        // Save updated cart to localStorage
        localStorage.setItem('cart', JSON.stringify(cart))

        // Show a notification that the item was added to localStorage
        showModal(
          modal,
          'Notification',
          'Item added to cart (local storage). Please log in to complete the purchase.'
        )
        $('#Modal_alert button').on('click', function () {
          if (modal.hasClass('fade')) {
            location.reload() // Reload to update the cart
          }
        })
      }
    }
  })
}

function renderProductsList() {
  const priceSlider = document.getElementById('price-slider')
  const priceMinInput = document.getElementById('price-min')
  const priceMaxInput = document.getElementById('price-max')
  const productContainer = document.getElementById('get_product')
  const sortingSelect = document.querySelector('.sort-by-select select')
  const itemsPerPageSelect = document.querySelector('.pagniation-input select')
  const paginationContainer = document.getElementById('pageno')
  const searchInput = document.querySelector(
    '.store-sort-type.text-search input'
  )

  let currentPage = 1 // Start at the first page
  let itemsPerPage = parseInt(itemsPerPageSelect.value) // Default items per page
  let searchQuery = ''

  // Desired range for the slider (e.g., 100,000 to 10,000,000)
  const minRange = 0
  const maxRange = 50000

  // Initialize noUiSlider
  if (priceSlider.noUiSlider) {
    priceSlider.noUiSlider.destroy()
  }
  noUiSlider.create(priceSlider, {
    start: [minRange, maxRange / 2], // Initial slider values
    connect: true, // Connect the handles
    range: {
      min: minRange,
      max: maxRange,
    },
    step: 100,
    // tooltips: [true, true],
    format: {
      to: (value) => Math.round(value),
      from: (value) => Number(value),
    },
  })

  // Function to update transform of noUi-origin elements
  function updateSliderOriginTransform() {
    const origins = document.querySelectorAll('.noUi-origin')
    origins.forEach((origin, index) => {
      const currentValue = priceSlider.noUiSlider.get()[index]
      const percentageValue =
        ((currentValue - minRange) / (maxRange - minRange)) * 100 // Calculate percentage for x position
      origin.style.transform = `translate(${percentageValue}%, 0px)` // Move it by 100% of the x-axis
    })
  }

  // Update slider on input change
  function updateSlider() {
    priceSlider.noUiSlider.set([priceMinInput.value, priceMaxInput.value])
  }

  // Helper function to filter and sort products
  function filterAndSortProducts() {
    currentPage = 1 // Reset to first page

    const minPrice = parseFloat(priceMinInput.value) || minRange
    const maxPrice = parseFloat(priceMaxInput.value) || maxRange
    const sortType = sortingSelect.value

    searchQuery = searchInput.value.trim().toLowerCase()

    if (originProducts.length === 0) {
      productsToFilter = Array.from(
        productContainer.querySelectorAll('.product')
      )
      originProducts = productsToFilter
    }

    // Reset the filtered list to original
    productsToFilter = [...originProducts]

    // Filter products by price range
    productsToFilter = productsToFilter.filter((product) => {
      const price = parseFloat(
        product.querySelector('.product-price').textContent.replace('$', '')
      )
      const productName = product
        .querySelector('.product-name a')
        .textContent.trim()
        .toLowerCase()

      return (
        price >= minPrice &&
        price <= maxPrice &&
        productName.includes(searchQuery)
      )
    })

    // Sort products based on the selected criteria
    productsToFilter.sort((a, b) => {
      const priceA = parseFloat(
        a.querySelector('.product-price').textContent.replace('$', '')
      )
      const priceB = parseFloat(
        b.querySelector('.product-price').textContent.replace('$', '')
      )
      const discountA = parseInt(
        a.querySelector('.sale').textContent.replace('%', '')
      )
      const discountB = parseInt(
        b.querySelector('.sale').textContent.replace('%', '')
      )

      if (sortType === 'Expensive') {
        if (priceB == priceA) return discountB - discountA // Descending by discount
        return priceB - priceA // Descending by price
      } else if (sortType === 'Cheap') {
        if (priceB == priceA) return discountB - discountA // Descending by discount
        return priceA - priceB // Ascending by price
      } else if (sortType === 'Discount') {
        if (discountB == discountA) return priceB - priceA // Descending by price
        return discountB - discountA // Descending by discount
      }
    })

    // Re-render pagination based on filtered items
    renderPagination(productsToFilter.length)

    // Update the visible products
    updateVisibleProducts()

    // Update the container with the filtered and sorted products
    // productContainer.innerHTML = `
    //     ${filteredProducts.map(product => `<div class='col-md-4 col-xs-6'> ${product.outerHTML} </div>` ).join("")}
    // `;
  }

  // Pagination handler
  function renderPagination(totalItems) {
    const totalPages = Math.ceil(totalItems / itemsPerPage)
    paginationContainer.innerHTML = ''

    // Create the `<<` button to go to the first page
    const firstPageItem = document.createElement('li')
    firstPageItem.innerHTML = `<a href="#"><i class="fa fa-angles-left"></i></a>`
    if (currentPage === 1 || currentPage === 2) {
      firstPageItem.classList.add('disabled') // Add a class for disabled styling
    } else {
      firstPageItem.classList.remove('disabled') // Remove a class for disabled styling
    }
    firstPageItem.addEventListener('click', function (e) {
      e.preventDefault()
      if (currentPage > 1) {
        currentPage = 1
        updateVisibleProducts()
        renderPagination(totalItems)
      }
    })
    paginationContainer.appendChild(firstPageItem)

    // Determine the range of pages to display
    let startPage = Math.max(1, currentPage - 1) // Show one page before the current
    let endPage = Math.min(totalPages, currentPage + 1) // Show one page after the current

    // Adjust the range to always display 3 buttons, if possible
    if (currentPage === 1) {
      endPage = Math.min(3, totalPages)
    } else if (currentPage === totalPages) {
      startPage = Math.max(1, totalPages - 2)
    }

    // Create the page number buttons
    for (let i = startPage; i <= endPage; i++) {
      const pageItem = document.createElement('li')
      pageItem.innerHTML = `<a href="#">${i}</a>`
      pageItem.querySelector('a').className = i === currentPage ? 'active' : ''
      pageItem.addEventListener('click', function (e) {
        e.preventDefault()
        currentPage = i
        updateVisibleProducts()
        renderPagination(totalItems)
      })
      paginationContainer.appendChild(pageItem)
    }

    // Create the `>>` button to go to the last page
    const lastPageItem = document.createElement('li')
    lastPageItem.innerHTML = `<a href="#"><i class="fa fa-angles-right"></i></a>`
    if (currentPage === totalPages || currentPage === totalPages - 1) {
      lastPageItem.classList.add('disabled') // Add a class for disabled styling
    } else {
      lastPageItem.classList.remove('disabled') // Remove a class for disabled styling
    }

    lastPageItem.addEventListener('click', function (e) {
      e.preventDefault()
      if (currentPage < totalPages) {
        currentPage = totalPages
        updateVisibleProducts()
        renderPagination(totalItems)
      }
    })
    paginationContainer.appendChild(lastPageItem)
  }

  // Update visible products based on pagination
  function updateVisibleProducts() {
    const startIndex = (currentPage - 1) * itemsPerPage
    const endIndex = startIndex + itemsPerPage

    const visibleProducts = productsToFilter.slice(startIndex, endIndex)
    productContainer.innerHTML = `
            ${visibleProducts
              .map(
                (product) =>
                  `<div class='col-md-4 col-xs-6'>${product.outerHTML}</div>`
              )
              .join('')}
        `
  }

  // Prevent max price from being below 100
  priceSlider.noUiSlider.on('update', function (values, handle) {
    const minPrice = parseInt(values[0], 10)
    const maxPrice = parseInt(values[1], 10)

    // Check if maxPrice is below 100
    if (maxPrice < 100) {
      // Set maxPrice back to 100 if dragged below the limit
      priceSlider.noUiSlider.set([minPrice, 100])
    }
  })

  // Update inputs on slider change
  priceSlider.noUiSlider.on('update', function (values) {
    priceMinInput.value = values[0]
    priceMaxInput.value = values[1]
    updateSliderOriginTransform()
    filterAndSortProducts()
  })

  // Event: Update slider on input change
  priceMinInput.addEventListener('change', function () {
    updateSlider()
    filterAndSortProducts()
  })
  priceMaxInput.addEventListener('change', function () {
    updateSlider()
    filterAndSortProducts()
  })

  // Event: Sorting dropdown change
  sortingSelect.addEventListener('change', filterAndSortProducts)

  // Event: Show pagination dropdown change
  itemsPerPageSelect.addEventListener('change', function () {
    itemsPerPage = parseInt(this.value)
    filterAndSortProducts()
  })

  // Event: Search events
  searchInput.addEventListener('input', filterAndSortProducts)

  // Event: Increase/Decrease inputs
  document.querySelectorAll('.qty-up').forEach((btn) => {
    btn.addEventListener('click', function () {
      const input = this.parentNode.querySelector('input')
      input.value = parseInt(input.value) + 500
      updateSlider()
      filterAndSortProducts()
    })
  })

  document.querySelectorAll('.qty-down').forEach((btn) => {
    btn.addEventListener('click', function () {
      const input = this.parentNode.querySelector('input')
      input.value = Math.max(0, parseInt(input.value) - 100) // Ensure non-negative
      updateSlider()
      filterAndSortProducts()
    })
  })
}
