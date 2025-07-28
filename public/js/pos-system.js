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
            card.addEventListener('click', async () => {
                const categoryId = card.dataset.categoryId;
                const categoryName = card.dataset.categoryName;
                await this.showTablesForCategory(categoryId, categoryName);
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
            if (this.selectedTableId && this.orderItems.length > 0) {
                if (confirm('Are you sure you want to cancel this table session? This will clear all items and make the table available again.')) {
                    this.cancelTableSession();
                }
            } else {
                this.orderItems = [];
                this.updateOrderDisplay();
            }
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
            
            if (productName.includes(searchTerm)) {
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
            
            const matchesCategory = category === 'all' || itemCategory === category;
            const matchesSearch = !searchTerm || productName.includes(searchTerm);
            
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

    async showTablesForCategory(categoryId, categoryName) {
        this.currentCategory = this.categoryData.find(cat => cat.id == categoryId);
        if (!this.currentCategory) return;

        document.getElementById('categoriesView').style.display = 'none';
        document.getElementById('tablesCanvasView').style.display = 'flex';
        document.getElementById('tablesSubtitle').textContent = `Select a table in ${categoryName}`;
        
        document.getElementById('canvasCategoryTitle').textContent = categoryName;
        
        const availableCount = this.currentCategory.tables.filter(t => t.status === 'available').length;
        const occupiedCount = this.currentCategory.tables.filter(t => t.status === 'occupied').length;
        const totalCount = this.currentCategory.tables.length;
        
        // Calculate total revenue from all tables
        this.calculateTotalRevenue().then(totalRevenue => {
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
                    <span class="stat-number" style="color: #059669;">€${totalRevenue.toFixed(2)}</span>
                    <span class="stat-label">Total Revenue</span>
                </span>
            `;
        });

        await this.renderTablesOnCanvas();
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

    async renderTablesOnCanvas() {
        const canvas = document.getElementById('tablesCanvas');
        if (!canvas) return;
        
        canvas.innerHTML = '';
        
        if (!this.currentCategory || !this.currentCategory.tables) {
            return;
        }
        
        // Batch fetch all table amounts in a single request
        const tableIds = this.currentCategory.tables.map(table => table.id);
        const tableAmounts = await this.getTableAmountsBatch(tableIds);
        
        // Create document fragment for better performance
        const fragment = document.createDocumentFragment();
        
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
            
            // Use cached amount or default to 0
            const totalAmount = tableAmounts[table.id] || 0;
            tableElement.innerHTML = `
                <div class="table-number">${table.table_number}</div>
                <div class="table-amount">€${totalAmount.toFixed(2)}</div>
                <div class="table-capacity">${table.capacity} seats</div>
            `;
            
            tableElement.addEventListener('click', () => this.selectTable(tableElement));
            
            fragment.appendChild(tableElement);
        });
        
        // Single DOM insertion
        canvas.appendChild(fragment);
    }

    async getTableTotalAmount(tableId) {
        try {
            const response = await fetch(`/pos/get-table-session?table_id=${tableId}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            const data = await response.json();
            
            if (data.success && data.session_data && data.session_data.total_amount) {
                return data.session_data.total_amount;
            } else {
                return 0;
            }
        } catch (error) {
            console.error('Error getting table total amount:', error);
            return 0;
        }
    }

    async getTableAmountsBatch(tableIds) {
        try {
            const response = await fetch('/pos/get-table-amounts-batch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ table_ids: tableIds })
            });
            const data = await response.json();
            
            if (data.success && data.table_amounts) {
                return data.table_amounts;
            } else {
                return {};
            }
        } catch (error) {
            console.error('Error getting table amounts batch:', error);
            return {};
        }
    }

    async refreshTableAmounts() {
        if (!this.currentCategory || !this.currentCategory.tables) return;

        const tableIds = this.currentCategory.tables.map(table => table.id);
        const tableAmounts = await this.getTableAmountsBatch(tableIds);

        this.currentCategory.tables.forEach(table => {
            const tableElement = document.querySelector(`[data-table-id="${table.id}"]`);
            if (tableElement) {
                const totalAmount = tableAmounts[table.id] || 0;
                const amountElement = tableElement.querySelector('.table-amount');
                if (amountElement) {
                    amountElement.textContent = `€${totalAmount.toFixed(2)}`;
                }
            }
        });
    }

    async calculateTotalRevenue() {
        if (!this.currentCategory || !this.currentCategory.tables) return 0;

        let totalRevenue = 0;
        const promises = this.currentCategory.tables.map(table => 
            this.getTableTotalAmount(table.id)
        );
        
        const amounts = await Promise.all(promises);
        totalRevenue = amounts.reduce((sum, amount) => sum + amount, 0);
        
        return totalRevenue;
    }

    selectTable(tableElement) {
        document.querySelectorAll('.canvas-table-item').forEach(t => t.classList.remove('selected'));
        tableElement.classList.add('selected');
        
        this.selectedTableId = tableElement.dataset.tableId;
        this.selectedTableNumber = tableElement.dataset.tableNumber;
        
        document.getElementById('selectedTableNumber').textContent = this.selectedTableNumber;
        document.getElementById('modalTableNumber').textContent = this.selectedTableNumber;
        
        // Check if table has an active session
        this.checkTableSession();
    }

    checkTableSession() {
        if (!this.selectedTableId || !this.authenticatedWaiter) return;

        fetch(`/pos/get-table-session?table_id=${this.selectedTableId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Table has active session, load existing items
                this.loadSessionData(data.session_data);
            } else {
                // No active session, start new one
                this.startTableSession();
            }
        })
        .catch(error => {
            console.error('Error checking table session:', error);
            // Start new session on error
            this.startTableSession();
        });
    }

    startTableSession() {
        if (!this.selectedTableId || !this.authenticatedWaiter) return;

        fetch('/pos/start-table-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                table_id: this.selectedTableId,
                waiter_id: this.authenticatedWaiter.id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.loadSessionData(data.session_data);
                this.showOrderPanel();
            } else {
                alert('Failed to start table session: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error starting table session:', error);
            alert('Error starting table session');
        });
    }

    loadSessionData(sessionData) {
        this.currentSessionData = sessionData;
        this.orderItems = sessionData.items || [];
        this.updateOrderDisplay();
        this.showOrderPanel();
        this.refreshTableAmounts();
    }

    showOrderPanel() {
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
        document.getElementById('quantityNotes').value = '';
        this.currentProduct = null;
    }

    addToOrder() {
        const quantity = parseInt(document.getElementById('quantityInput').value);
        
        if (!this.selectedTableId || !this.authenticatedWaiter) {
            alert('Please select a table and ensure waiter is authenticated');
            return;
        }

        fetch('/pos/add-item-to-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                table_id: this.selectedTableId,
                product_id: this.currentProduct.id,
                quantity: quantity,
                unit_price: this.currentProduct.price,
                notes: document.getElementById('quantityNotes')?.value || null
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.loadSessionData(data.session_data);
                this.closeQuantityModal();
            } else {
                alert('Failed to add item: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error adding item:', error);
            alert('Error adding item to order');
        });
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
                    <div class="order-item" data-item-id="${item.id}">
                        <div class="item-info">
                            <h4>${item.product_name || item.name}</h4>
                            <p>$${item.unit_price.toFixed(2)} x ${item.quantity}</p>
                            ${item.notes ? `<p class="text-xs text-gray-500">Note: ${item.notes}</p>` : ''}
                        </div>
                        <div class="item-actions">
                            <div class="item-total">$${item.total_price.toFixed(2)}</div>
                            <button class="remove-item-btn text-red-600 hover:text-red-800 text-sm" onclick="window.posSystem.removeItem('${item.id}')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            });
            orderItemsContainer.innerHTML = itemsHtml;
        }
        
        this.updateTotals();
    }

    updateTotals() {
        const subtotal = this.orderItems.reduce((sum, item) => sum + (item.total_price || (item.price * item.quantity)), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
        document.getElementById('total').textContent = `$${total.toFixed(2)}`;
    }

    removeItem(itemId) {
        if (!this.selectedTableId) return;

        fetch('/pos/remove-item-from-session', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                table_id: this.selectedTableId,
                item_id: itemId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.loadSessionData(data.session_data);
            } else {
                alert('Failed to remove item: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error removing item:', error);
            alert('Error removing item from order');
        });
    }

    cancelTableSession() {
        if (!this.selectedTableId) return;

        fetch('/pos/cancel-table-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                table_id: this.selectedTableId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.orderItems = [];
                this.currentSessionData = null;
                this.updateOrderDisplay();
                this.closeOrderPanel();
                
                if (this.currentCategory) {
                    this.renderTablesOnCanvas();
                } else {
                    this.refreshTableAmounts();
                }
                
                alert('Table session cancelled successfully');
            } else {
                alert('Failed to cancel session: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error cancelling session:', error);
            alert('Error cancelling table session');
        });
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
        
        const subtotal = this.orderItems.reduce((sum, item) => sum + (item.total_price || (item.price * item.quantity)), 0);
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

        if (!this.selectedTableId) {
            alert('No table selected');
            return;
        }

        fetch('/pos/finalize-table-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                table_id: this.selectedTableId,
                payment_method: this.selectedPaymentMethod,
                notes: document.getElementById('orderNotes')?.value || null
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Order finalized successfully!\nOrder ID: ${data.order_id}\nTotal: $${data.total_amount}\nPayment: ${data.payment_method}\nWaiter: ${this.authenticatedWaiter ? this.authenticatedWaiter.name : 'Unknown'}`);
                
                this.orderItems = [];
                this.currentSessionData = null;
                this.updateOrderDisplay();
                this.closePaymentModal();
                this.closeOrderPanel();
                
                if (this.currentCategory) {
                    this.renderTablesOnCanvas();
                } else {
                    this.refreshTableAmounts();
                }
            } else {
                alert('Failed to finalize order: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error finalizing order:', error);
            alert('Error finalizing order. Please try again.');
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