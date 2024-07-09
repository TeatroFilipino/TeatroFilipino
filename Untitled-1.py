def basket(fruits):
    if fruits:
        print(fruits[0], end=" ")
        basket(fruits[1:])

fruits_list = ["apple", "banana", "orange", "grape"]
basket(fruits_list)
