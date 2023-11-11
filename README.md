# Backend Application Readme

This readme file provides an overview of the Backend Application challenge and outlines the implementation details and evaluation criteria.

## Challenge Idea

The main objective of the Backend Application challenge is to create an API endpoint that retrieves and filters data from two data providers, namely DataProviderX and DataProviderY. The data is stored in JSON files and requires filter operations to obtain the desired results.

Here are the schemas for DataProviderX and DataProviderY:

**DataProviderX schema:**

```json
{
  "parentAmount": 200,
  "Currency": "USD",
  "parentEmail": "parent1@parent.eu",
  "statusCode": 1,
  "registerationDate": "2018-11-30",
  "parentIdentification": "d3d29d70-1d25-11e3-8591-034165a3a613"
}
```

DataProviderX has three status codes:

- `1`: authorized
- `2`: declined
- `3`: refunded

**DataProviderY schema:**

```json
{
  "balance": 300,
  "currency": "AED",
  "email": "parent2@parent.eu",
  "status": 100,
  "created_at": "22/12/2018",
  "id": "4fc2-a8d1"
}
```

DataProviderY has three status codes:

- `100`: authorized
- `200`: declined
- `300`: refunded



## Implementation Details

The Backend Application challenge has been implemented using PHP Laravel. The API endpoint `/api/v1/users` retrieves and filters data from DataProviderX and DataProviderY JSON files.

The implementation includes the following features:

1. **Listing Users:** The API endpoint lists all users by combining transactions from DataProviderX and DataProviderY.
2. **Filtering by Provider:** The API supports filtering results by payment providers. For example, `/api/v1/users?provider=DataProviderX` returns users from DataProviderX.
3. **Filtering by Status Code:** The API supports filtering results by status code (authorized, declined, refunded). For example, `/api/v1/users?statusCode=authorized` returns users with the status code "authorized."
4. **Filtering by Amount Range:** The API supports filtering results by an amount range. For example, `/api/v1/users?balanceMin=10&balanceMax=100` returns users with balances between 10 and 100 (inclusive).
5. **Filtering by Currency:** The API supports filtering results by currency.
6. **Combined Filters:** The API can combine multiple filters together to narrow down the results.

## Implementation Details

The implementation of the Backend Application challenge 

1. **Code Quality:** The code is well-designed, follows best practices, and adheres to Laravel conventions.
2. **Application Performance:** The application efficiently handles the reading of large JSON files and performs filtering operations effectively.
3. **Code Scalability:** The code is easily extensible to add new data providers (e.g., DataProviderZ) without significant modifications.
4. **Unit Test Coverage:** The code has comprehensive unit tests that ensure its functionality and prevent regressions.
5. **Docker:** The application is containerized using Docker for easy deployment and reproducibility.
6. ### Admin Panel

The application includes an admin panel accessible at `/admin` for dynamic control of providers.

- **Admin Credentials:**
  - Username: `admin`
  - Password: `admin`

#### Available Actions

1. **Add Provider:**
   - Access the admin panel at `/admin`.
   - Use the provided credentials to log in.
   - Navigate to the "Providers" section.
   - Add a new provider by providing necessary details such as `name`, `email`, `balance`, `status`, `currency`, `identification`, `authorized`, `declined`, `created_at`, and `created_at_format`.

2. **Modify Provider:**
   - Edit existing providers by selecting the desired provider in the admin panel.

3. **Remove Provider:**
   - Remove a provider by selecting the delete option in the admin panel.

7. **Efficient Data Filtering with Chunking::** To ensure efficient processing of large files, the implementation utilizes chunking. Chunking breaks down the data into smaller, manageable portions, enabling filtering operations to be performed on smaller subsets of data at a time. This approach minimizes memory usage and prevents potential performance issues when dealing with large datasets. By employing chunking, the application can handle large files without compromising performance or encountering memory limitations.

8. **Caching for Improved Performance::**  Caching is implemented to enhance performance and reduce server load. When a request is made, the system checks if the same request has been made within the last 60 minutes. If so, the response is retrieved from the cache and returned without reprocessing the request. This significantly reduces the load on the server and improves response times for frequently requested data. By utilizing caching, the system provides faster responses and optimizes resource utilization, resulting in an improved user experience.

9. **Repository Service Pattern:::** The implementation follows the Repository Service Pattern, which separates the data access logic from the business logic. The repository acts as an intermediary between the application and the data providers, encapsulating the data access operations. The service layer handles the business logic and utilizes the repositories to retrieve and process the data. This pattern promotes code modularity, testability, and maintainability by separating concerns and providing a clear separation of responsibilities.

## Getting Started

To run the Backend Application, follow these steps:

1. Clone the repository.
2. Install the required dependencies by running `composer install`.
3. Set up your database credentials in the `.env` file.
4. Migrate the database using `php artisan migrate`.
5. Start the server by running `php artisan serve`.
6. The application will be accessible at `http://localhost:8000`.

## Testing

To run the unit tests for the Backend Application, use the command `php artisan test`. The tests ensure the functionality of the API endpoint and validate the implemented filters.

## Docker

The application has been containerized using Docker for easy deployment and reproducibility. To run the application using Docker, follow these steps:

1. Install Docker on your machine.
2. Build the Docker image by running `docker build -t backend-application .` in the project directory.
3. Run the Docker container using `docker run -p 8000:8000 backend-application`.
4. The application will be accessible at `http://localhost:8000`.

## Conclusion

The Backend Application challenge demonstrates your skills in building an API endpoint that retrieves and filters data from multiple sources. The implementation meets the acceptance criteria and includes features such as listing users, filtering by provider, status code, amount range, currency, and combining multiple filters.

The code follows best practices, performs efficiently, and is easily scalable to accommodate additional data providers. It is thoroughly tested, ensuring its functionality and preventing regressions. The application is containerized using Docker for seamless deployment and reproducibility.

If you have any further questions or need clarification, please feel free to ask. Good luck with your implementation and delivery of the Backend Application!