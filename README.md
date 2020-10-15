# OpenFraudCart
Rewritten and upgraded version of FraudCart (made by slaves, published by DarkBASIC)

Overview of most changes:
- Updated from Laravel 5.7 to 8.9 with all its dependencies
- Adding orders logic rewritten
- Enables multiple up to thousands of digital orders at once
- Implementation of caching to reduce app load and increase performance, which has been increased up to 100 times for certain operations
- Reduced number of queries in general
- Unnecessary cron jobs removed
