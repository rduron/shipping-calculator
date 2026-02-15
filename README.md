 # Shipping Calculator
### Minimal shipping price calculator built with:
 - PHP 8.1
 - Symfony 6.4.33
 - Vue 3
 - Docker 27.4.0
 - PHPUnit 9.6.34

# Getting Started

## 1. Clone repository

```shell
git clone https://github.com/rduron/shipping-calculator.git
cd shipping-calculator
```

## 2. Start Docker containers
```shell
make up
```

### Frontend available at
```http request
http://localhost:5173
```

### Backend available at
```http request
http://localhost:8080
```

# API
## POST /api/shipping/calculate
### Request
```json
{
  "carrier": "transcompany",
  "weightKg": 5
}
```
### Response Success
```json
{
  "carrier": "transcompany",
  "weightKg": 5,
  "currency": "EUR",
  "price": 20
}
```

### Response Failed (400)
```json
{
  "error": "Unsupported carrier"
}
```

# Running Tests
## Run all tests
```shell
make test
```

## Test Coverage
### Unit tests
- Each pricing strategy
- ShippingCalculator

### Functional tests
 - API endpoint
   - Success scenario
   - Error scenario
   - Validation handling

# Development Notes
## CORS
Configured via Nelmio CORS bundle for local development.

## Validation
Uses Symfony Validator:
- carrier must be string and not blank
- weight must be numeric and > 0

Validation errors return:
```json
{
  "error": "Validation failed"
}
```

# Example Workflow
1. Start containers
2. Open frontend
3. Select carrier
4. Enter weight
5. Calculate price
6. Observe result or error

# Stopping Containers
```shell
make down
```