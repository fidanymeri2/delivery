# Waiter Order API - Frontend Developer Guide

Quick reference for implementing waiter order functionality in your frontend application.

## Base URL
```
/api/table-management
```

## Authentication
Include your authentication token in headers:
```
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json
```

---

## 🍽️ **Tables Management**

### Get Available Tables
```http
GET /api/table-management/tables/available
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "table_number": "Table 1",
      "capacity": 4,
      "status": "available",
      "category": {
        "name": "Hall 1"
      }
    }
  ]
}
```

### Get Tables by Category
```http
GET /api/table-management/tables/category/{categoryId}
```

### Update Table Status
```http
PUT /api/table-management/tables/{tableId}/status
```

**Body:**
```json
{
  "status": "occupied"
}
```

---

## 📋 **Order Management**

### Create New Order
```http
POST /api/table-management/orders
```

**Body:**
```json
{
  "restaurant_table_id": 1,
  "waiter_id": 1,
  "notes": "Customer prefers spicy food"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "status": "open",
    "total_amount": "0.00",
    "table": {
      "table_number": "Table 1",
      "category": { "name": "Hall 1" }
    }
  }
}
```

### Get Order Details
```http
GET /api/table-management/orders/{orderId}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "status": "open",
    "total_amount": "45.50",
    "table": { "table_number": "Table 1" },
    "items": [
      {
        "id": 1,
        "quantity": 2,
        "unit_price": "12.50",
        "total_price": "25.00",
        "special_instructions": "Extra cheese",
        "product": {
          "name": "Margherita Pizza",
          "image": "pizza.jpg"
        }
      }
    ]
  }
}
```

### Add Item to Order
```http
POST /api/table-management/orders/{orderId}/items
```

**Body:**
```json
{
  "product_id": 1,
  "quantity": 2,
  "unit_price": 12.50,
  "special_instructions": "Extra cheese, no onions"
}
```

### Update Order Item
```http
PUT /api/table-management/orders/{orderId}/items/{itemId}
```

**Body:**
```json
{
  "quantity": 3,
  "unit_price": 12.50,
  "special_instructions": "Extra cheese"
}
```

### Remove Item from Order
```http
DELETE /api/table-management/orders/{orderId}/items/{itemId}
```

### Close Order
```http
PUT /api/table-management/orders/{orderId}/close
```

### Cancel Order
```http
PUT /api/table-management/orders/{orderId}/cancel
```

---

## 👨‍💼 **Waiter Operations**

### Get Waiter's Active Orders
```http
GET /api/table-management/waiter/{waiterId}/active-orders
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "status": "open",
      "total_amount": "45.50",
      "table": { "table_number": "Table 1" },
      "items": [...]
    }
  ]
}
```

### Get All Waiter's Orders
```http
GET /api/table-management/waiter/{waiterId}/orders
```

---

## 🛍️ **Products & Data**

### Get Available Products
```http
GET /api/table-management/products
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Margherita Pizza",
      "price": 12.50,
      "image": "pizza.jpg",
      "category": { "name": "Pizza" }
    }
  ]
}
```

### Get Waiters List
```http
GET /api/table-management/waiters
```

---

## 📊 **Dashboard Stats**

### Get Order Statistics
```http
GET /api/table-management/dashboard/stats
```

**Response:**
```json
{
  "success": true,
  "data": {
    "total_orders": 25,
    "active_orders": 8,
    "today_orders": 5,
    "today_revenue": 125.50
  }
}
```

---

## 🔄 **Typical Waiter Workflow**

### 1. **Start Shift** - Get Available Tables
```javascript
// Get tables available for orders
GET /api/table-management/tables/available
```

### 2. **Create Order** - When customer sits at table
```javascript
// Create new order for table
POST /api/table-management/orders
{
  "restaurant_table_id": 1,
  "waiter_id": 1,
  "notes": "Customer request"
}
```

### 3. **Add Items** - Take customer order
```javascript
// Add items to order
POST /api/table-management/orders/{orderId}/items
{
  "product_id": 1,
  "quantity": 2,
  "unit_price": 12.50,
  "special_instructions": "Extra cheese"
}
```

### 4. **Update Items** - Modify order if needed
```javascript
// Update item quantity or instructions
PUT /api/table-management/orders/{orderId}/items/{itemId}
{
  "quantity": 3,
  "special_instructions": "Extra cheese, no onions"
}
```

### 5. **Close Order** - When customer pays
```javascript
// Close the order
PUT /api/table-management/orders/{orderId}/close
```

---

## 📱 **Frontend Implementation Example**

### Angular Service
```typescript
@Injectable()
export class WaiterOrderService {
  private baseUrl = '/api/table-management';

  constructor(private http: HttpClient) {}

  // Get available tables
  getAvailableTables() {
    return this.http.get(`${this.baseUrl}/tables/available`);
  }

  // Create new order
  createOrder(tableId: number, waiterId: number, notes?: string) {
    return this.http.post(`${this.baseUrl}/orders`, {
      restaurant_table_id: tableId,
      waiter_id: waiterId,
      notes
    });
  }

  // Add item to order
  addItem(orderId: number, productId: number, quantity: number, price: number, instructions?: string) {
    return this.http.post(`${this.baseUrl}/orders/${orderId}/items`, {
      product_id: productId,
      quantity,
      unit_price: price,
      special_instructions: instructions
    });
  }

  // Close order
  closeOrder(orderId: number) {
    return this.http.put(`${this.baseUrl}/orders/${orderId}/close`, {});
  }
}
```

### React Hook Example
```javascript
const useWaiterOrders = () => {
  const [tables, setTables] = useState([]);
  const [orders, setOrders] = useState([]);

  const getAvailableTables = async () => {
    const response = await fetch('/api/table-management/tables/available');
    const data = await response.json();
    setTables(data.data);
  };

  const createOrder = async (tableId, waiterId, notes) => {
    const response = await fetch('/api/table-management/orders', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ restaurant_table_id: tableId, waiter_id: waiterId, notes })
    });
    return response.json();
  };

  return { tables, orders, getAvailableTables, createOrder };
};
```

---

## ⚠️ **Important Notes**

1. **Table Status**: Automatically updates to "occupied" when order is created
2. **Order Total**: Automatically calculated when items are added/updated
3. **Table Release**: Automatically released when order is closed/cancelled
4. **Error Handling**: Always check `success` field in responses
5. **Authentication**: Include token in all requests

---

## 🚀 **Quick Start Checklist**

- [ ] Get available tables
- [ ] Create order for selected table
- [ ] Add products to order
- [ ] Update quantities/instructions
- [ ] Close order when payment received
- [ ] Handle table status updates
- [ ] Implement error handling
- [ ] Add loading states
- [ ] Test all workflows 