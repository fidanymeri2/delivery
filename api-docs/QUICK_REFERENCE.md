# 🚀 Waiter Order API - Quick Reference

## Essential Endpoints for Frontend Development

### 📋 **Core Operations**

| Operation | Method | Endpoint | Description |
|-----------|--------|----------|-------------|
| Get Tables | `GET` | `/tables/available` | Get available tables |
| Create Order | `POST` | `/orders` | Start new order |
| Add Item | `POST` | `/orders/{id}/items` | Add product to order |
| Update Item | `PUT` | `/orders/{id}/items/{itemId}` | Modify order item |
| Remove Item | `DELETE` | `/orders/{id}/items/{itemId}` | Remove from order |
| Close Order | `PUT` | `/orders/{id}/close` | Complete order |
| Get Products | `GET` | `/products` | Get menu items |

### 🔄 **Typical Workflow**

```javascript
// 1. Get available tables
GET /api/table-management/tables/available

// 2. Create order for table
POST /api/table-management/orders
{
  "restaurant_table_id": 1,
  "waiter_id": 1,
  "notes": "Customer request"
}

// 3. Add items to order
POST /api/table-management/orders/1/items
{
  "product_id": 1,
  "quantity": 2,
  "unit_price": 12.50,
  "special_instructions": "Extra cheese"
}

// 4. Close order
PUT /api/table-management/orders/1/close
```

### 📱 **Frontend Service (Angular)**

```typescript
@Injectable()
export class WaiterService {
  private baseUrl = '/api/table-management';

  constructor(private http: HttpClient) {}

  // Get available tables
  getTables() {
    return this.http.get(`${this.baseUrl}/tables/available`);
  }

  // Create order
  createOrder(tableId: number, waiterId: number, notes?: string) {
    return this.http.post(`${this.baseUrl}/orders`, {
      restaurant_table_id: tableId,
      waiter_id: waiterId,
      notes
    });
  }

  // Add item
  addItem(orderId: number, productId: number, quantity: number, price: number) {
    return this.http.post(`${this.baseUrl}/orders/${orderId}/items`, {
      product_id: productId,
      quantity,
      unit_price: price
    });
  }

  // Close order
  closeOrder(orderId: number) {
    return this.http.put(`${this.baseUrl}/orders/${orderId}/close`, {});
  }
}
```

### 🎯 **Key Features**

✅ **Automatic table status management**
✅ **Real-time order totals**
✅ **Special instructions support**
✅ **Waiter-specific orders**
✅ **Product integration**
✅ **Payment tracking**

### ⚡ **Response Format**

```json
{
  "success": true,
  "data": [...],
  "message": "Operation completed"
}
```

### 🚨 **Error Handling**

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "field": ["Error message"]
  }
}
```

---

**📖 Full Documentation:** See `WAITER_ORDER_API.md` for complete details 