# Table Management API Documentation

This API provides endpoints for managing restaurant tables, categories, and orders for your Angular frontend.

## Base URL
```
/api/table-management
```

## Authentication
All endpoints require authentication. Include your authentication token in the request headers.

## Table Categories

### Get All Categories
```
GET /api/table-management/categories
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Hall 1",
      "description": "Main dining hall with indoor seating",
      "status": "active",
      "sort_order": 1,
      "created_at": "2025-07-28T08:44:00.000000Z",
      "updated_at": "2025-07-28T08:44:00.000000Z"
    }
  ]
}
```

### Get Single Category
```
GET /api/table-management/categories/{id}
```

### Create Category
```
POST /api/table-management/categories
```

**Request Body:**
```json
{
  "name": "Hall 3",
  "description": "VIP dining area",
  "status": "active",
  "sort_order": 4
}
```

### Update Category
```
PUT /api/table-management/categories/{id}
```

### Delete Category
```
DELETE /api/table-management/categories/{id}
```

## Restaurant Tables

### Get All Tables
```
GET /api/table-management/tables
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "table_category_id": 1,
      "table_number": "Table 1",
      "status": "available",
      "capacity": 4,
      "notes": "Window seat",
      "sort_order": 1,
      "category": {
        "id": 1,
        "name": "Hall 1"
      }
    }
  ]
}
```

### Get Tables by Category
```
GET /api/table-management/tables/category/{categoryId}
```

### Get Available Tables
```
GET /api/table-management/tables/available
```

### Get Occupied Tables
```
GET /api/table-management/tables/occupied
```

### Create Table
```
POST /api/table-management/tables
```

**Request Body:**
```json
{
  "table_category_id": 1,
  "table_number": "Table 5",
  "status": "available",
  "capacity": 6,
  "notes": "Corner table",
  "sort_order": 5
}
```

### Update Table Status
```
PUT /api/table-management/tables/{id}/status
```

**Request Body:**
```json
{
  "status": "occupied"
}
```

### Update Table
```
PUT /api/table-management/tables/{id}
```

### Delete Table
```
DELETE /api/table-management/tables/{id}
```

## Table Orders

### Get All Orders
```
GET /api/table-management/orders
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "restaurant_table_id": 1,
      "waiter_id": 1,
      "status": "open",
      "payment_status": "pending",
      "total_amount": "45.50",
      "table": {
        "id": 1,
        "table_number": "Table 1",
        "category": {
          "name": "Hall 1"
        }
      },
      "waiter": {
        "id": 1,
        "name": "John Doe"
      },
      "items": [
        {
          "id": 1,
          "product_id": 1,
          "quantity": 2,
          "unit_price": "12.50",
          "total_price": "25.00",
          "product": {
            "name": "Margherita Pizza"
          }
        }
      ]
    }
  ]
}
```

### Get Single Order
```
GET /api/table-management/orders/{id}
```

### Create Order
```
POST /api/table-management/orders
```

**Request Body:**
```json
{
  "restaurant_table_id": 1,
  "waiter_id": 1,
  "notes": "Customer prefers spicy food"
}
```

### Update Order
```
PUT /api/table-management/orders/{id}
```

**Request Body:**
```json
{
  "restaurant_table_id": 1,
  "waiter_id": 1,
  "status": "open",
  "payment_status": "partial",
  "payment_method": "cash",
  "notes": "Updated notes"
}
```

### Close Order
```
PUT /api/table-management/orders/{id}/close
```

### Cancel Order
```
PUT /api/table-management/orders/{id}/cancel
```

### Delete Order
```
DELETE /api/table-management/orders/{id}
```

## Order Items

### Add Item to Order
```
POST /api/table-management/orders/{orderId}/items
```

**Request Body:**
```json
{
  "product_id": 1,
  "quantity": 2,
  "unit_price": 12.50,
  "special_instructions": "Extra cheese, no onions"
}
```

### Update Order Item
```
PUT /api/table-management/orders/{orderId}/items/{itemId}
```

**Request Body:**
```json
{
  "quantity": 3,
  "unit_price": 12.50,
  "special_instructions": "Extra cheese, no onions"
}
```

### Remove Order Item
```
DELETE /api/table-management/orders/{orderId}/items/{itemId}
```

## Waiter Specific Endpoints

### Get Waiter's Orders
```
GET /api/table-management/waiter/{waiterId}/orders
```

### Get Waiter's Active Orders
```
GET /api/table-management/waiter/{waiterId}/active-orders
```

## Status Values

### Table Status
- `available` - Table is free
- `occupied` - Table has an active order
- `reserved` - Table is reserved
- `maintenance` - Table is under maintenance

### Order Status
- `open` - Order is active
- `closed` - Order is completed
- `cancelled` - Order is cancelled

### Payment Status
- `pending` - Payment not received
- `paid` - Full payment received
- `partial` - Partial payment received

### Payment Method
- `cash` - Cash payment
- `card` - Card payment
- `bank_transfer` - Bank transfer

### Category Status
- `active` - Category is active
- `inactive` - Category is inactive

## Error Responses

All endpoints return error responses in this format:

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

## Example Usage in Angular

```typescript
// Get all tables
this.http.get('/api/table-management/tables').subscribe(
  (response: any) => {
    this.tables = response.data;
  }
);

// Create new order
this.http.post('/api/table-management/orders', {
  restaurant_table_id: 1,
  waiter_id: 1,
  notes: 'Customer request'
}).subscribe(
  (response: any) => {
    console.log('Order created:', response.data);
  }
);

// Add item to order
this.http.post(`/api/table-management/orders/${orderId}/items`, {
  product_id: 1,
  quantity: 2,
  unit_price: 12.50
}).subscribe(
  (response: any) => {
    console.log('Item added:', response.data);
  }
);
```

## Notes for Angular Frontend

1. **Real-time Updates**: Consider using WebSockets or polling for real-time order updates
2. **Error Handling**: Always handle API errors gracefully
3. **Loading States**: Show loading indicators during API calls
4. **Validation**: Implement client-side validation before API calls
5. **Authentication**: Include authentication tokens in all requests
6. **Offline Support**: Consider implementing offline capabilities for basic operations 