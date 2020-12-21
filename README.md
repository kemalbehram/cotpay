## Một số quy tắc đặt tên cần tuân thủ


#### Tên Biến (variable_name): Đặt chuẩn cú pháp con rắn (snake_case).

Cú pháp: **Tất cả các chữ cái đều viết thường, và các từ cách nhau bởi dấu gạch dưới.**

VD: `$product_name`, `$user_email` , `$category_id`, `$this_is_the_name_follow_the_snake_case`


#### Tên Hàm  (functionName): Đặt chuẩn cú pháp lạc đà (camelCase)

Cú pháp: **Ký tự đầu tiên của từ đầu tiên viết thường, những ký tự đầu tiên của những từ tiếp theo viết hoa.**

VD: `getProductNameAttribute()`, `showQuestionByUser()`, `updateProductBySlug()`, `thisIsTheNameFollowTheCamelCase()`


#### Tên Lớp (ClassName): Đặt chuẩn cú pháp Pascal (PascalCase)

Cú pháp: **viết hoa chữ cái đầu tiên của mỗi từ.**

VD: `ProductModel`, `ProductController`, `StoreProductRequest`, `ThisIsTheNameFollowThePascalCase`


#### khi đặt tên thì nên chú ý số lượng của thực thể

VD:
```php
    $user =  User::all(); // sai vì User::all(); sẽ trả ra Colection bao gồm tất cả các Models/User (số nhiều)
    $users = User::all(); // nên đặt lại như này cho đúng

    $categories = Category::where('id', $id)->first(); // sai vì hàm Category::find() sẽ trả ra Models/Category (số it)
    $category = Category::where('id', $id)->first(); // nên đặt lại như này cho đúng

    $food = Food::where('id', $id)->get();  // sai vì User::all(); sẽ trả ra Colection bao gồm tất cả các Models/Food (số nhiều)
    $foods = Food::where('id', $id)->get(); // nên đặt lại như này cho đúng
```

#### Tránh đặt những vô nghĩa. 

VD: `$abc`, `$dfljsi`, `$bien_cua_toi`, `$bien_1`, `$b2`, `$fgdb`, `getDaSuDflf()`, `setAtsNas()`, `PrsroMel`, `ClassDGH`


#### không được đặt tên kiểu viết tắt. 

VD: `setProName()`, `getCateName()`, `$cate_id`, `$p`, `$off_food`, `ClassCateFood`.


# Khi viết code cần tránh sử dụng Tiếng Việt nên viết (HOÀN TOÀN BẰNG) Tiếng Anh
