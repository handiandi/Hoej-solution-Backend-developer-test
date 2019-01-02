# Hoej - Solution - Backend-developer-test
This is a solution to the Backend devolper test from Hoej.dk: https://github.com/Hoej/backend-developer-test 
I have written a very simple filter script, to solve the following task: 

1. Return all orders that have a specific product (e.g. "Logitech mouse")
2. Return all orders that have products that are made of a specific material (e.g. "Plastic")
3. Return all orders that have products without parts

There are two files: 
1. `index.php` - only contains the object/method calls for Orders.
2. `Orders.php` - Contains the logic to solve the test/task 

### Thoughts about the solution
Right now it just pretty print the output using `print_r` method in PHP. This could be re-written so it's more REST API friendly, ex. json output. 