// POS System JavaScript Module
class POSSystem {
    constructor() {
        this.currentCategory = null;
        this.selectedTableId = null;
        this.selectedTableNumber = null;
        this.orderItems = [];
        this.currentProduct = null;
        this.authenticatedWaiter = null;
        this.categoryData = [];
        this.selectedPaymentMethod = null;
        
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.updateDateTime();
        setInterval(() => this.updateDateTime(), 1000);
    }

    setupEventListeners() {
        this.setupWaiterAuthentication();
        this.setupCategoryNavigation();
        this.setupProductSearch();
        this.setupProductFiltering();
        this.setupOrderManagement();
        this.setupPaymentHandling();
        this.setupModalHandling();
    }

    setupWaiterAuthentication() {
        const pinInput = document.getElementById('waiterPin');
        const pinDots = document.querySelectorAll('.pin-dot');
        const pinError = document.getElementById('pinError');
        const waiterInfo = document.getElementById('waiterInfo');
        const loginBtn = document.getElementById('loginBtn');
        const clearPinBtn = document.getElementById('clearPinBtn');
        const logoutBtn = document.getElementById('logoutBtn');

        if (pinInput) {
            pinInput.addEventListener('input', (e) => {
                const pin = e.target.value;
                this.updatePinDots(pin, pinDots);
                pinError.style.display = 'none';
                
                if (pin.length === 4) {
                    this.authenticateWaiter(pin);
                }
            });
        }

        if (loginBtn) {
            loginBtn.addEventListener('click', () => {
                const pin = pinInput.value;
                if (pin.length === 4) {
                    this.authenticateWaiter(pin);
                } else {
                    pinError.style.display = 'flex';
                    pinError.querySelector('span').textContent = 'Please enter a 4-digit PIN code.';
                    pinInput.focus();
                }
            });
        }

        if (clearPinBtn) {
            clearPinBtn.addEventListener('click', () => {
                pinInput.value = '';
                pinDots.forEach(dot => dot.classList.remove('filled'));
                pinError.style.display = 'none';
                waiterInfo.style.display = 'none';
                pinInput.focus();
            });
        }

        if (logoutBtn) {
            logoutBtn.addEventListener('click', () => this.logout());
        }
    }

    setupCategoryNavigation() {
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', () => {
                const categoryId = card.dataset.categoryId;
                const categoryName = card.dataset.categoryName;
                this.showTablesForCategory(categoryId, categoryName);
            });
        });

        document.getElementById('backToCategories')?.addEventListener('click', () => {
            this.showCategoriesView();
        });
    }

    setupProductSearch() {
        const searchInput = document.getElementById('productSearch');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase().trim();
                this.filterProducts(searchTerm);
            });
        }
    }

    setupProductFiltering() {
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                const category = tab.dataset.category;
                const searchTerm = document.getElementById('productSearch')?.value.toLowerCase().trim() || '';
                this.filterProductsByCategory(category, searchTerm);
            });
        });
    }

    setupOrderManagement() {
        document.querySelectorAll('.add-to-table-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (!this.selectedTableId) {
                    alert('Please select a table first');
                    return;
                }
                
                const price = parseFloat(btn.dataset.productPrice);
                if (price <= 0) {
                    alert('This product has no price set');
                    return;
                }
                
                this.currentProduct = {
                    id: btn.dataset.productId,
                    name: btn.dataset.productName,
                    price: price
                };
                
                this.showQuantityModal();
            });
        });

        document.getElementById('clearOrder')?.addEventListener('click', () => {
            this.orderItems = [];
            this.updateOrderDisplay();
        });

        document.getElementById('processOrder')?.addEventListener('click', () => {
            this.processOrder();
        });
    }

    setupPaymentHandling() {
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', () => {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                option.classList.add('selected');
                this.selectedPaymentMethod = option.dataset.method;
                document.getElementById('confirmPayment').disabled = false;
            });
        });

        document.getElementById('confirmPayment')?.addEventListener('click', () => {
            this.confirmPayment();
        });

        document.getElementById('closePaymentModal')?.addEventListener('click', () => {
            this.closePaymentModal();
        });

        document.getElementById('cancelPayment')?.addEventListener('click', () => {
            this.closePaymentModal();
        });
    }

    setupModalHandling() {
        // Quantity modal controls
        document.getElementById('decreaseQty')?.addEventListener('click', () => {
            const input = document.getElementById('quantityInput');
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });

        document.getElementById('increaseQty')?.addEventListener('click', () => {
            const input = document.getElementById('quantityInput');
            if (input.value < 10) {
                input.value = parseInt(input.value) + 1;
            }
        });

        document.getElementById('confirmAdd')?.addEventListener('click', () => {
            this.addToOrder();
        });

        document.getElementById('closeModal')?.addEventListener('click', () => {
            this.closeQuantityModal();
        });

        document.getElementById('cancelAdd')?.addEventListener('click', () => {
            this.closeQuantityModal();
        });

        // Menu modal
        document.getElementById('closeMenuModal')?.addEventListener('click', () => {
            document.getElementById('menuModal').classList.remove('show');
        });

        document.getElementById('menuModal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                e.currentTarget.classList.remove('show');
            }
        });

        // Order panel
        document.getElementById('closeOrderPanel')?.addEventListener('click', () => {
            this.closeOrderPanel();
        });
    }

    updatePinDots(pin, pinDots) {
        pinDots.forEach((dot, index) => {
            if (index < pin.length) {
                dot.classList.add('filled');
            } else {
                dot.classList.remove('filled');
            }
        });
    }

    authenticateWaiter(pin) {
        // Send authentication request to backend
        fetch('/pos/authenticate-waiter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ pin_code: pin })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Authentication successful
                this.authenticatedWaiter = data.waiter;
                document.getElementById('waiterName').textContent = data.waiter.name;
                document.getElementById('waiterId').textContent = `ID: ${data.waiter.id}`;
                document.getElementById('headerWaiterName').textContent = data.waiter.name;
                
                document.getElementById('waiterInfo').style.display = 'flex';
                
                setTimeout(() => {
                    document.getElementById('waiterAuthModal').style.display = 'none';
                    document.getElementById('posMain').style.display = 'flex';
                    document.getElementById('waiterDisplay').style.display = 'flex';
                }, 500);
                
            } else {
                // Authentication failed
                document.getElementById('pinError').style.display = 'flex';
                document.getElementById('pinError').querySelector('span').textContent = data.message || 'Invalid PIN code';
                document.getElementById('waiterPin').value = '';
                document.querySelectorAll('.pin-dot').forEach(dot => dot.classList.remove('filled'));
                document.getElementById('waiterPin').focus();
            }
        })
        .catch(error => {
            console.error('Authentication error:', error);
            document.getElementById('pinError').style.display = 'flex';
            document.getElementById('pinError').querySelector('span').textContent = 'Network error. Please try again.';
            document.getElementById('waiterPin').value = '';
            document.querySelectorAll('.pin-dot').forEach(dot => dot.classList.remove('filled'));
            document.getElementById('waiterPin').focus();
        });
    }

    logout() {
        this.authenticatedWaiter = null;
        document.getElementById('waiterAuthModal').style.display = 'flex';
        document.getElementById('posMain').style.display = 'none';
        document.getElementById('waiterDisplay').style.display = 'none';
        
        const pinInput = document.getElementById('waiterPin');
        pinInput.value = '';
        document.querySelectorAll('.pin-dot').forEach(dot => dot.classList.remove('filled'));
        document.getElementById('pinError').style.display = 'none';
        document.getElementById('waiterInfo').style.display = 'none';
        
        this.orderItems = [];
        this.selectedTableId = null;
        this.selectedTableNumber = null;
        this.currentCategory = null;
        
        pinInput.focus();
    }

    updateDateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        const dateString = now.toLocaleDateString();
        
        const timeElement = document.getElementById('currentTime');
        const dateElement = document.getElementById('currentDate');
        
        if (timeElement) timeElement.textContent = timeString;
        if (dateElement) dateElement.textContent = dateString;
    }

    filterProducts(searchTerm) {
        const productItems = document.querySelectorAll('.product-item');
        const noProductsMessage = document.getElementById('noProductsMessage');
        let visibleCount = 0;
        
        productItems.forEach(item => {
            const productName = item.querySelector('.product-name').textContent.toLowerCase();
            const productDescription = item.querySelector('.product-description').textContent.toLowerCase();
            
            if (productName.includes(searchTerm) || productDescription.includes(searchTerm)) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        if (visibleCount === 0 && searchTerm) {
            noProductsMessage.style.display = 'flex';
        } else {
            noProductsMessage.style.display = 'none';
        }
        
        if (searchTerm) {
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
            document.querySelector('.category-tab[data-category="all"]').classList.add('active');
        }
    }

    filterProductsByCategory(category, searchTerm) {
        let visibleCount = 0;
        document.querySelectorAll('.product-item').forEach(item => {
            const itemCategory = item.dataset.category;
            const productName = item.querySelector('.product-name').textContent.toLowerCase();
            const productDescription = item.querySelector('.product-description').textContent.toLowerCase();
            
            const matchesCategory = category === 'all' || itemCategory === category;
            const matchesSearch = !searchTerm || productName.includes(searchTerm) || productDescription.includes(searchTerm);
            
            if (matchesCategory && matchesSearch) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        const noProductsMessage = document.getElementById('noProductsMessage');
        if (visibleCount === 0) {
            noProductsMessage.style.display = 'flex';
        } else {
            noProductsMessage.style.display = 'none';
        }
    }

    showTablesForCategory(categoryId, categoryName) {
        this.currentCategory = this.categoryData.find(cat => cat.id == categoryId);
        if (!this.currentCategory) return;

        document.getElementById('categoriesView').style.display = 'none';
        document.getElementById('tablesCanvasView').style.display = 'flex';
        document.getElementById('tablesSubtitle').textContent = `Select a table in ${categoryName}`;
        
        document.getElementById('canvasCategoryTitle').textContent = categoryName;
        
        const availableCount = this.currentCategory.tables.filter(t => t.status === 'available').length;
        const occupiedCount = this.currentCategory.tables.filter(t => t.status === 'occupied').length;
        const totalCount = this.currentCategory.tables.length;
        
        document.getElementById('canvasStats').innerHTML = `
            <span class="stat-item">
                <span class="stat-number" style="color: #10b981;">${availableCount}</span>
                <span class="stat-label">Available</span>
            </span>
            <span class="stat-item">
                <span class="stat-number" style="color: #ef4444;">${occupiedCount}</span>
                <span class="stat-label">Occupied</span>
            </span>
            <span class="stat-item">
                <span class="stat-number" style="color: #3b82f6;">${totalCount}</span>
                <span class="stat-label">Total</span>
            </span>
        `;

        this.renderTablesOnCanvas();
    }

    showCategoriesView() {
        document.getElementById('categoriesView').style.display = 'block';
        document.getElementById('tablesCanvasView').style.display = 'none';
        document.getElementById('tablesSubtitle').textContent = 'Select a category to view tables';
        this.currentCategory = null;
        this.selectedTableId = null;
        this.selectedTableNumber = null;
        document.getElementById('selectedTableNumber').textContent = 'None';
        document.getElementById('orderPanel').style.display = 'none';
    }

    renderTablesOnCanvas() {
        const canvas = document.getElementById('tablesCanvas');
        canvas.innerHTML = '';
        
        if (!this.currentCategory || !this.currentCategory.tables) {
            return;
        }
        
        this.currentCategory.tables.forEach((table, index) => {
            let x, y, width, height, zIndex;
            
            if (table.positions && table.positions.length > 0) {
                const position = table.positions[0];
                x = position.x_position;
                y = position.y_position;
                width = position.width;
                height = position.height;
                zIndex = position.z_index;
            } else {
                const tablesPerRow = 4;
                const row = Math.floor(index / tablesPerRow);
                const col = index % tablesPerRow;
                x = 50 + (col * 120);
                y = 50 + (row * 100);
                width = 100;
                height = 80;
                zIndex = index;
            }
            
            const tableElement = document.createElement('div');
            tableElement.className = 'canvas-table-item';
            tableElement.dataset.tableId = table.id;
            tableElement.dataset.tableNumber = table.table_number;
            tableElement.style.left = x + 'px';
            tableElement.style.top = y + 'px';
            tableElement.style.width = width + 'px';
            tableElement.style.height = height + 'px';
            tableElement.style.zIndex = zIndex;
            tableElement.classList.add(table.status);
            
            tableElement.innerHTML = `
                <div class="table-number">${table.table_number}</div>
                <div class="table-status">${table.status.toUpperCase()}</div>
                <div class="table-capacity">${table.capacity} seats</div>
            `;
            
            tableElement.addEventListener('click', () => this.selectTable(tableElement));
            
            canvas.appendChild(tableElement);
        });
    }

    selectTable(tableElement) {
        document.querySelectorAll('.canvas-table-item').forEach(t => t.classList.remove('selected'));
        tableElement.classList.add('selected');
        
        this.selectedTableId = tableElement.dataset.tableId;
        this.selectedTableNumber = tableElement.dataset.tableNumber;
        
        document.getElementById('selectedTableNumber').textContent = this.selectedTableNumber;
        document.getElementById('modalTableNumber').textContent = this.selectedTableNumber;
        
        const orderPanel = document.getElementById('orderPanel');
        orderPanel.style.display = 'flex';
        setTimeout(() => {
            orderPanel.classList.add('show');
        }, 10);
        
        document.getElementById('menuModal').classList.add('show');
        
        document.querySelectorAll('.add-to-table-btn').forEach(btn => {
            btn.disabled = false;
        });
    }

    showQuantityModal() {
        document.getElementById('modalProductName').textContent = this.currentProduct.name;
        document.getElementById('modalProductPrice').textContent = `$${this.currentProduct.price.toFixed(2)}`;
        document.getElementById('quantityModal').classList.add('show');
    }

    closeQuantityModal() {
        document.getElementById('quantityModal').classList.remove('show');
        document.getElementById('quantityInput').value = 1;
        this.currentProduct = null;
    }

    addToOrder() {
        const quantity = parseInt(document.getElementById('quantityInput').value);
        
        const existingItem = this.orderItems.find(item => item.id === this.currentProduct.id);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            this.orderItems.push({
                id: this.currentProduct.id,
                name: this.currentProduct.name,
                price: this.currentProduct.price,
                quantity: quantity
            });
        }
        
        this.updateOrderDisplay();
        this.closeQuantityModal();
    }

    updateOrderDisplay() {
        const orderItemsContainer = document.getElementById('orderItems');
        
        if (this.orderItems.length === 0) {
            orderItemsContainer.innerHTML = `
                <div class="empty-order">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p>No items in order</p>
                    <span>Select products from the menu</span>
                </div>
            `;
        } else {
            let itemsHtml = '';
            this.orderItems.forEach(item => {
                itemsHtml += `
                    <div class="order-item">
                        <div class="item-info">
                            <h4>${item.name}</h4>
                            <p>$${item.price.toFixed(2)} x ${item.quantity}</p>
                        </div>
                        <div class="item-total">$${(item.price * item.quantity).toFixed(2)}</div>
                    </div>
                `;
            });
            orderItemsContainer.innerHTML = itemsHtml;
        }
        
        this.updateTotals();
    }

    updateTotals() {
        const subtotal = this.orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
        document.getElementById('total').textContent = `$${total.toFixed(2)}`;
    }

    processOrder() {
        if (this.orderItems.length === 0) {
            alert('No items in order');
            return;
        }
        
        if (!this.selectedTableId) {
            alert('Please select a table first');
            return;
        }
        
        const subtotal = this.orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        document.getElementById('paymentTotal').textContent = `$${total.toFixed(2)}`;
        document.getElementById('paymentModal').classList.add('show');
    }

    confirmPayment() {
        if (!this.selectedPaymentMethod) {
            alert('Please select a payment method');
            return;
        }

        const subtotal = this.orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;

        const orderData = {
            table_id: this.selectedTableId,
            waiter_id: this.authenticatedWaiter ? this.authenticatedWaiter.id : 5,
            payment_method: this.selectedPaymentMethod,
            items: this.orderItems.map(item => ({
                product_id: item.id,
                quantity: item.quantity,
                unit_price: item.price
            })),
            total_amount: total,
            notes: null
        };

        fetch('/pos/process-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Order processed successfully!\nOrder ID: ${data.order_id}\nTotal: $${data.total_amount}\nPayment: ${data.payment_method}\nWaiter: ${this.authenticatedWaiter ? this.authenticatedWaiter.name : 'Unknown'}`);
                
                this.orderItems = [];
                this.updateOrderDisplay();
                this.closePaymentModal();
                this.closeOrderPanel();
                
                if (this.currentCategory) {
                    this.renderTablesOnCanvas();
                }
            } else {
                alert('Failed to process order: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error processing order:', error);
            alert('Error processing order. Please try again.');
        });
    }

    closePaymentModal() {
        document.getElementById('paymentModal').classList.remove('show');
        this.selectedPaymentMethod = null;
        document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
        document.getElementById('confirmPayment').disabled = true;
    }

    closeOrderPanel() {
        document.getElementById('orderPanel').classList.remove('show');
        setTimeout(() => {
            document.getElementById('orderPanel').style.display = 'none';
        }, 300);
    }

    setCategoryData(data) {
        this.categoryData = data;
    }
}

// Initialize POS System when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.posSystem = new POSSystem();
    
    // Show authentication modal on page load
    document.getElementById('waiterAuthModal').style.display = 'flex';
    
    // Set category data if available
    if (typeof categoryData !== 'undefined') {
        window.posSystem.setCategoryData(categoryData);
    }
}); 