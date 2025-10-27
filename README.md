# Admin API

This is the Admin API for managing users, roles, and permissions in the system. It provides endpoints for creating, updating, deleting, and retrieving user information, as well as managing roles and permissions.

## Base URL

The base URL for the Admin API is:## Authentication

The Admin API uses token-based authentication. You must include an `Authorization` header with a valid token in each request WITH GET METHOD.
- **Header:** `Authorization: Bearer {token}`
```api
https://localhost:8000/api
```

## Endpoints

### Users

#### Get All Users
- **URL:** `/users`
- **Method:** `GET`
- **Description:** Retrieve a paginated list of users.
- **Authentication:** Required.

#### Get User by ID
- **URL:** `/users/{id}`
- **Method:** `GET`
- **Description:** Retrieve a single user by their ID.
- **Authentication:** Required.

#### Create User
- **URL:** `/users`
- **Method:** `POST`
- **Description:** Create a new user.
- **Authentication:** Required.
- **Body Parameters:**
  - `f_name` (string, required): First name of the user.
  - `l_name` (string, required): Last name of the user.
  - `email` (string, required): Email address of the user.
  - `password` (string, required): Password for the user.
  - `role_id` (integer, required): Role ID for the user.

#### Update User
- **URL:** `/users/{id}`
- **Method:** `PUT`
- **Description:** Update an existing user by their ID.
- **Authentication:** Required.
- **Body Parameters:**
  - `f_name` (string, optional): First name of the user.
  - `l_name` (string, optional): Last name of the user.
  - `email` (string, optional): Email address of the user.
  - `password` (string, optional): Password for the user.
  - `role_id` (integer, optional): Role ID for the user.

#### Delete User
- **URL:** `/users/{id}`
- **Method:** `DELETE`
- **Description:** Delete a user by their ID.
- **Authentication:** Required.

#### Get Authenticated User
- **URL:** `/user`
- **Method:** `GET`
- **Description:** Retrieve the currently authenticated user.
- **Authentication:** Required.

#### Update Authenticated User Info
- **URL:** `/user/info`
- **Method:** `PUT`
- **Description:** Update the profile information of the currently authenticated user.
- **Authentication:** Required.
- **Body Parameters:**
  - `f_name` (string, optional): First name of the user.
  - `l_name` (string, optional): Last name of the user.
  - `email` (string, optional): Email address of the user.

#### Update Authenticated User Password
- **URL:** `/user/password`
- **Method:** `PUT`
- **Description:** Update the password of the currently authenticated user.
- **Authentication:** Required.
- **Body Parameters:**
  - `password` (string, required): New password for the user.

## Roles and Permissions

Endpoints for managing roles and permissions can be added here.

## Error Handling

The API returns standard HTTP status codes to indicate the success or failure of a request. Common status codes include:

- `200 OK`: The request was successful.
- `201 Created`: A new resource was successfully created.
- `202 Accepted`: The request was accepted and processed.
- `400 Bad Request`: The request was invalid or cannot be processed.
- `401 Unauthorized`: Authentication failed or token is missing.
- `404 Not Found`: The requested resource was not found.
- `500 Internal Server Error`: An error occurred on the server.

## License

This project is licensed under the [MIT License](LICENSE).
