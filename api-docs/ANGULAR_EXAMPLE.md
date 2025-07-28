# 📱 Angular Implementation Example

Complete example of how to implement the waiter order system in Angular.

## 🏗️ **Project Structure**

```
src/
├── app/
│   ├── services/
│   │   └── waiter-order.service.ts
│   ├── models/
│   │   ├── table.model.ts
│   │   ├── order.model.ts
│   │   └── product.model.ts
│   ├── components/
│   │   ├── table-list/
│   │   ├── order-form/
│   │   └── product-selector/
│   └── pages/
│       └── waiter-dashboard/
```

## 📋 **Models**

### `table.model.ts`
```typescript
export interface Table {
  id: number;
  table_number: string;
  capacity: number;
  status: 'available' | 'occupied' | 'reserved' | 'maintenance';
  category: {
    name: string;
  };
}

export interface TableCategory {
  id: number;
  name: string;
  description: string;
  status: 'active' | 'inactive';
}
```

### `order.model.ts`
```typescript
export interface Order {
  id: number;
  restaurant_table_id: number;
  waiter_id: number;
  status: 'open' | 'closed' | 'cancelled';
  payment_status: 'pending' | 'paid' | 'partial';
  total_amount: number;
  notes?: string;
  table: Table;
  items: OrderItem[];
  created_at: string;
}

export interface OrderItem {
  id: number;
  product_id: number;
  quantity: number;
  unit_price: number;
  total_price: number;
  special_instructions?: string;
  product: Product;
}
```

### `product.model.ts`
```typescript
export interface Product {
  id: number;
  name: string;
  price: number;
  image?: string;
  category: {
    name: string;
  };
}
```

## 🔧 **Service**

### `waiter-order.service.ts`
```typescript
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Table, Order, Product } from '../models';

@Injectable({
  providedIn: 'root'
})
export class WaiterOrderService {
  private baseUrl = '/api/table-management';

  constructor(private http: HttpClient) {}

  // Tables
  getAvailableTables(): Observable<{success: boolean, data: Table[]}> {
    return this.http.get<{success: boolean, data: Table[]}>(`${this.baseUrl}/tables/available`);
  }

  getTablesByCategory(categoryId: number): Observable<{success: boolean, data: Table[]}> {
    return this.http.get<{success: boolean, data: Table[]}>(`${this.baseUrl}/tables/category/${categoryId}`);
  }

  updateTableStatus(tableId: number, status: string): Observable<any> {
    return this.http.put(`${this.baseUrl}/tables/${tableId}/status`, { status });
  }

  // Orders
  createOrder(tableId: number, waiterId: number, notes?: string): Observable<{success: boolean, data: Order}> {
    return this.http.post<{success: boolean, data: Order}>(`${this.baseUrl}/orders`, {
      restaurant_table_id: tableId,
      waiter_id: waiterId,
      notes
    });
  }

  getOrder(orderId: number): Observable<{success: boolean, data: Order}> {
    return this.http.get<{success: boolean, data: Order}>(`${this.baseUrl}/orders/${orderId}`);
  }

  closeOrder(orderId: number): Observable<any> {
    return this.http.put(`${this.baseUrl}/orders/${orderId}/close`, {});
  }

  cancelOrder(orderId: number): Observable<any> {
    return this.http.put(`${this.baseUrl}/orders/${orderId}/cancel`, {});
  }

  // Order Items
  addItemToOrder(orderId: number, productId: number, quantity: number, price: number, instructions?: string): Observable<any> {
    return this.http.post(`${this.baseUrl}/orders/${orderId}/items`, {
      product_id: productId,
      quantity,
      unit_price: price,
      special_instructions: instructions
    });
  }

  updateOrderItem(orderId: number, itemId: number, quantity: number, price: number, instructions?: string): Observable<any> {
    return this.http.put(`${this.baseUrl}/orders/${orderId}/items/${itemId}`, {
      quantity,
      unit_price: price,
      special_instructions: instructions
    });
  }

  removeOrderItem(orderId: number, itemId: number): Observable<any> {
    return this.http.delete(`${this.baseUrl}/orders/${orderId}/items/${itemId}`);
  }

  // Products
  getProducts(): Observable<{success: boolean, data: Product[]}> {
    return this.http.get<{success: boolean, data: Product[]}>(`${this.baseUrl}/products`);
  }

  // Waiter specific
  getWaiterOrders(waiterId: number): Observable<{success: boolean, data: Order[]}> {
    return this.http.get<{success: boolean, data: Order[]}>(`${this.baseUrl}/waiter/${waiterId}/orders`);
  }

  getWaiterActiveOrders(waiterId: number): Observable<{success: boolean, data: Order[]}> {
    return this.http.get<{success: boolean, data: Order[]}>(`${this.baseUrl}/waiter/${waiterId}/active-orders`);
  }
}
```

## 🎨 **Components**

### `waiter-dashboard.component.ts`
```typescript
import { Component, OnInit } from '@angular/core';
import { WaiterOrderService } from '../../services/waiter-order.service';
import { Table, Order, Product } from '../../models';

@Component({
  selector: 'app-waiter-dashboard',
  templateUrl: './waiter-dashboard.component.html',
  styleUrls: ['./waiter-dashboard.component.scss']
})
export class WaiterDashboardComponent implements OnInit {
  tables: Table[] = [];
  activeOrders: Order[] = [];
  products: Product[] = [];
  selectedTable: Table | null = null;
  currentOrder: Order | null = null;
  loading = false;
  waiterId = 1; // Get from auth service

  constructor(private waiterService: WaiterOrderService) {}

  ngOnInit() {
    this.loadAvailableTables();
    this.loadActiveOrders();
    this.loadProducts();
  }

  loadAvailableTables() {
    this.loading = true;
    this.waiterService.getAvailableTables().subscribe({
      next: (response) => {
        this.tables = response.data;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error loading tables:', error);
        this.loading = false;
      }
    });
  }

  loadActiveOrders() {
    this.waiterService.getWaiterActiveOrders(this.waiterId).subscribe({
      next: (response) => {
        this.activeOrders = response.data;
      },
      error: (error) => {
        console.error('Error loading orders:', error);
      }
    });
  }

  loadProducts() {
    this.waiterService.getProducts().subscribe({
      next: (response) => {
        this.products = response.data;
      },
      error: (error) => {
        console.error('Error loading products:', error);
      }
    });
  }

  selectTable(table: Table) {
    this.selectedTable = table;
  }

  createOrder() {
    if (!this.selectedTable) return;

    this.waiterService.createOrder(this.selectedTable.id, this.waiterId).subscribe({
      next: (response) => {
        this.currentOrder = response.data;
        this.loadActiveOrders();
        this.loadAvailableTables(); // Refresh tables
      },
      error: (error) => {
        console.error('Error creating order:', error);
      }
    });
  }

  addItemToOrder(productId: number, quantity: number, price: number, instructions?: string) {
    if (!this.currentOrder) return;

    this.waiterService.addItemToOrder(this.currentOrder.id, productId, quantity, price, instructions).subscribe({
      next: () => {
        this.loadOrderDetails();
      },
      error: (error) => {
        console.error('Error adding item:', error);
      }
    });
  }

  loadOrderDetails() {
    if (!this.currentOrder) return;

    this.waiterService.getOrder(this.currentOrder.id).subscribe({
      next: (response) => {
        this.currentOrder = response.data;
      },
      error: (error) => {
        console.error('Error loading order:', error);
      }
    });
  }

  closeOrder() {
    if (!this.currentOrder) return;

    this.waiterService.closeOrder(this.currentOrder.id).subscribe({
      next: () => {
        this.currentOrder = null;
        this.selectedTable = null;
        this.loadActiveOrders();
        this.loadAvailableTables();
      },
      error: (error) => {
        console.error('Error closing order:', error);
      }
    });
  }
}
```

### `waiter-dashboard.component.html`
```html
<div class="waiter-dashboard">
  <div class="header">
    <h1>Waiter Dashboard</h1>
    <div class="waiter-info">
      <span>Waiter ID: {{ waiterId }}</span>
    </div>
  </div>

  <div class="dashboard-content">
    <!-- Available Tables -->
    <div class="tables-section">
      <h2>Available Tables</h2>
      <div class="tables-grid" *ngIf="!loading">
        <div 
          class="table-card" 
          *ngFor="let table of tables"
          [class.selected]="selectedTable?.id === table.id"
          (click)="selectTable(table)">
          <h3>{{ table.table_number }}</h3>
          <p>{{ table.category.name }}</p>
          <p>Capacity: {{ table.capacity }}</p>
          <span class="status available">Available</span>
        </div>
      </div>
      <div class="loading" *ngIf="loading">Loading tables...</div>
    </div>

    <!-- Current Order -->
    <div class="order-section" *ngIf="currentOrder">
      <h2>Current Order - {{ currentOrder.table.table_number }}</h2>
      
      <div class="order-items">
        <div class="item" *ngFor="let item of currentOrder.items">
          <div class="item-info">
            <h4>{{ item.product.name }}</h4>
            <p>Qty: {{ item.quantity }} x ${{ item.unit_price }}</p>
            <p *ngIf="item.special_instructions">Notes: {{ item.special_instructions }}</p>
          </div>
          <div class="item-total">
            ${{ item.total_price }}
          </div>
        </div>
      </div>

      <div class="order-total">
        <h3>Total: ${{ currentOrder.total_amount }}</h3>
      </div>

      <div class="order-actions">
        <button class="btn btn-primary" (click)="closeOrder()">Close Order</button>
        <button class="btn btn-secondary" (click)="currentOrder = null">Cancel</button>
      </div>
    </div>

    <!-- Product Selection -->
    <div class="products-section" *ngIf="currentOrder">
      <h2>Add Items</h2>
      <div class="products-grid">
        <div class="product-card" *ngFor="let product of products">
          <img [src]="product.image" [alt]="product.name" *ngIf="product.image">
          <h4>{{ product.name }}</h4>
          <p>${{ product.price }}</p>
          <button class="btn btn-sm" (click)="addItemToOrder(product.id, 1, product.price)">
            Add
          </button>
        </div>
      </div>
    </div>

    <!-- Active Orders -->
    <div class="active-orders-section">
      <h2>Active Orders</h2>
      <div class="orders-list">
        <div class="order-card" *ngFor="let order of activeOrders">
          <h4>{{ order.table.table_number }}</h4>
          <p>Total: ${{ order.total_amount }}</p>
          <p>Items: {{ order.items.length }}</p>
          <button class="btn btn-sm" (click)="currentOrder = order">View</button>
        </div>
      </div>
    </div>
  </div>
</div>
```

## 🎯 **Key Features Implemented**

✅ **Table selection and status management**
✅ **Order creation and management**
✅ **Product selection and adding items**
✅ **Real-time order updates**
✅ **Order closing and table release**
✅ **Error handling and loading states**
✅ **Responsive design**

## 🚀 **Next Steps**

1. **Add authentication** - Integrate with your auth system
2. **Add real-time updates** - Use WebSockets for live updates
3. **Add payment processing** - Integrate payment methods
4. **Add order history** - Show past orders
5. **Add notifications** - Alert for new orders
6. **Add offline support** - Cache data for offline use

This example provides a complete foundation for building a waiter order system in Angular! 