<<<<<<< HEAD
# E-commerce-API
an API for an Ecommerce web app using laravel 11

API docs :

# Public endpoints

## login an existing user.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/email-login" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"email\": \"barry81@example.com\",
        \"password\": \"velit\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/email-login"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "email": "barry81@example.com",
        "password": "velit"
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
      "message": "user logged in successfully"
      "access_token": $token
    }

> Example response (422):

    {
        "error": "Sorry, those credentials do not match."
    }


## login an existing user using phone number.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/Phone-number-login" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"phone_number\": \"bqijrfsccfg\",
        \"password\": \"dolore\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/Phone-number-login"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "phone_number": "bqijrfsccfg",
        "password": "dolore"
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
      "message": "user logged in successfully"
      "access_token": $token
    }

> Example response (422):

    {
        "error": "Sorry, those credentials do not match."
    }


## creates a new user.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/register" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"first_name\": \"iynkhmaevfimbwyf\",
        \"last_name\": \"nyryatmbqraqnyecriwgpbhzv\",
        \"email\": \"acarter@example.com\",
        \"password\": \"pT`D]t`un?l5[\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/register"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "first_name": "iynkhmaevfimbwyf",
        "last_name": "nyryatmbqraqnyecriwgpbhzv",
        "email": "acarter@example.com",
        "password": "pT`D]t`un?l5["
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
      "message": "User created successfully. Verify your email to complete registration."
      "access_token": $token
    }

> Example response (422):

    {
        "error": "validation errors"
    }


## user enters their phone number.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/enter-phone-number" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"phone_number\": \"51682350425\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/enter-phone-number"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "phone_number": "51682350425"
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
        "message": "Verify your phone number to complete registration."
    }

> Example response (422):

    {
        "error": "validation errors"
    }

# Protected endpoints

## verify user's email.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/register/verify-email" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"otp\": \"mmf\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/register/verify-email"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "otp": "mmf"
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
        "message": "email verified successfully"
    }

> Example response (422):

    {
        "error": "validation errors"
    }


## verify user's phone number.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/register/verify-Phone-number" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"code\": \"012345\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/register/verify-Phone-number"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "code": "012345"
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
        "message": "phone verified successfully"
    }

> Example response (422):

    {
        "error": "validation errors"
    }


## list and paginate all products of a specific category by the category_name attribute

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/{category\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/doloribus"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):

content-type: application/json     

    {
        "data": [
            {
                "id": 1,
                "name": "corrupti",
                "manufacturer": "Gleason-Olson",
                "price": "56.70",
                "discount": "1.65",
                "price_after_discount": 55.764450000000004,
                "stock_status": 0,
                "photo": null
            },
            {
                "id": 3,
                "name": "perferendis",
                "manufacturer": "Terry Ltd",
                "price": "23.40",
                "discount": "16.89",
                "price_after_discount": 19.44774,
                "stock_status": 0,
                "photo": null
            },
            {
                "id": 6,
                "name": "voluptates",
                "manufacturer": "Lindgren PLC",
                "price": "61.26",
                "discount": "40.42",
                "price_after_discount": 36.49870799999999,
                "stock_status": 0,
                "photo": null
            }
        ],
        "links": {
            "first": "http://e-commerce-api.test/api/V1/doloribus?page=1",
            "last": "http://e-commerce-api.test/api/V1/doloribus?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; Previous",
                    "active": false
                },
                {
                    "url": "http://e-commerce-api.test/api/V1/doloribus?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": null,
                    "label": "Next &raquo;",
                    "active": false
                }
            ],
            "path": "http://e-commerce-api.test/api/V1/doloribus",
            "per_page": 9,
            "to": 3,
            "total": 3
        }
    }


## list and paginate all products of a specific subcategory navigating through a main category

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/{category\_name}/sub-categories/{subCategory\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/doloribus/sub-categories/voluptates"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):

content-type: application/json    

    {
        "data": [
            {
                "id": 2,
                "name": "eveniet",
                "manufacturer": "Rogahn Ltd",
                "price": "62.97",
                "discount": "24.25",
                "price_after_discount": 47.699775,
                "stock_status": 0,
                "photo": null
            }
        ],
        "links": {
            "first": "http://e-commerce-api.test/api/V1/doloribus/sub-categories/voluptates?page=1",
            "last": "http://e-commerce-api.test/api/V1/doloribus/sub-categories/voluptates?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; Previous",
                    "active": false
                },
                {
                    "url": "http://e-commerce-api.test/api/V1/doloribus/sub-categories/voluptates?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": null,
                    "label": "Next &raquo;",
                    "active": false
                }
            ],
            "path": "http://e-commerce-api.test/api/V1/doloribus/sub-categories/voluptates",
            "per_page": 9,
            "to": 1,
            "total": 1
        }
    }

## viewe the details of a specific product navigating through its category

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/{category\_name}/products/{product\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/doloribus/products/corrupti"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):

content-type: application/json       

    {
        "data": {
            "id": 1,
            "name": "corrupti",
            "manufacturer": "Gleason-Olson",
            "description": "Temporibus dolores quia aut molestiae cumque dolores. Molestiae dolor dolores qui odio. Dolorem doloribus unde quisquam dolores et sit.",
            "price": "56.70",
            "discount": "1.65",
            "price_after_discount": 55.764450000000004,
            "stock_status": 0,
            "sub_category": null,
            "category": {
                "id": 1,
                "name": "doloribus"
            },
            "photos": []
        }
    }


## add a product of a specific category to user's cart.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/{category\_name}/products/{product\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"product_id\": \"in\",
        \"quantity\": 20
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/doloribus/products/corrupti"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "product_id": "in",
        "quantity": 20
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
        "message": "product added to cart successfully"
    }

> Example response (404): 

    {
        "message": "No query results for model [App\\Models\\Product] corrupti"
    }


## add a product of a specific subcategory to user's cart

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/{category\_name}/sub-categories/{subCategory\_name}/products/{product\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/doloribus/sub-categories/voluptates/products/corrupti"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):

    {
        "message": "product added to cart successfully"
    }

> Example response (404): 

    {
        "message": "No query results for model [App\\Models\\Product] corrupti"
    }


## view the contents of user's cart

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/cart-items" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/cart-items"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):
       
    {
        "cart_items": [
        {
            "cart_id": 12,
            "product_id": null,
            "quantity": 8,
            "price": "67.27",
            "subtotal": "79.96",
            "name": "sit",
            "thumbnail": null
        }
    ],
    "total_subtotal": 79.96
    }

> Example response (404):
       
    {
        "message": "your cart is empty"
    }

## view the details of a specific item in the user cart

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/cart-items/{cartItem\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/cart-items/eaque"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):

    {
        "data": {
            "id": 31,
            "name": "autem",
            "manufacturer": "O'Kon-Deckow",
            "description": "Velit cum illum omnis. Vitae deserunt aut sint sit enim dolorem voluptas et. Et omnis omnis sint.",
            "price": "53.78",
            "discount": "33.91",
            "price_after_discount": 35.543202,
            "stock_status": 0
        }
    }


## updates item's quantity inside user's cart.

> Example request:

    curl --request PATCH \
        "http://e-commerce-api.test/api/V1/cart-items/{cartItem\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"product_id\": \"culpa\",
        \"quantity\": 39
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/cart-items/eaque"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "product_id": "culpa",
        "quantity": 39
    };
    
    fetch(url, {
        method: "PATCH",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
        "message": "item updated successfully"
    }

> Example response (422):

    {
        "error": "validation errors"
    }


## removes an item from user's cart.

> Example request:

    curl --request DELETE \
        "http://e-commerce-api.test/api/V1/cart-items/{cartItem\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/cart-items/eaque"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "DELETE",
        headers,
    }).then(response => response.json());

> Example response (200):

    {
        "message": "item removed from cart successfully"
    }


## logout a user.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/logout" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/logout"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "POST",
        headers,
    }).then(response => response.json());

> Example response (200):

    {
        "message": "user logged out successfully"
    }

# Admin endpoints

## list all categories with their subcategories (if exists), uesd for a drop down menu where the user can select a category or a subcategory to add a product to

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/add-product/list-categories" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/add-product/list-categories"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):
       

    {
        "data": [
            {
                "id": 1,
                "name": "doloribus",
                "sub_categories": [
                    {
                        "id": 1,
                        "category_id": 1,
                        "name": "voluptates"
                    },
                    {
                        "id": 4,
                        "category_id": 1,
                        "name": "architecto"
                    }
                ]
            },
            
            {
                "id": 3,
                "name": "ratione",
                "sub_categories": []
            },
        ]
    }


## create a new product.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/add-product/create" \
        --header "Content-Type: multipart/form-data" \
        --header "Accept: application/json" \
        --form "name=tivytmrqeeuvgyeeep"\
        --form "manufacturer=xvayf"\
        --form "description=Iusto laborum possimus ducimus dignissimos."\
        --form "price=19"\
        --form "stock=24"\
        --form "productable_type=App\Models\SubCategory"\
        --form "productable_id=5"\
        --form "photos[]=@C:\Users\abdel\AppData\Local\Temp\php6C3F.tmp" 

    const url = new URL(
        "http://e-commerce-api.test/api/V1/add-product/create"
    );
    
    const headers = {
        "Content-Type": "multipart/form-data",
        "Accept": "application/json",
    };
    
    const body = new FormData();
    body.append('name', 'tivytmrqeeuvgyeeep');
    body.append('manufacturer', 'xvayf');
    body.append('description', 'Iusto laborum possimus ducimus dignissimos.');
    body.append('price', '19');
    body.append('stock', '24');
    body.append('productable_type', 'App\Models\SubCategory');
    body.append('productable_id', '5');
    body.append('photos[]', document.querySelector('input[name="photos[]"]').files[0]);
    
    fetch(url, {
        method: "POST",
        headers,
        body,
    }).then(response => response.json());

> Example response (200):

    {
        "message": "new product created successfully"
    }

> Example response (422):

    {
        "error": "validation errors"
    }


## update an existing product.

> Example request:

    curl --request PATCH \
        "http://e-commerce-api.test/api/V1/product/{product\_name}" \
        --header "Content-Type: multipart/form-data" \
        --header "Accept: application/json" \
        --form "name=hbcwrjbvgepofzmjf"\
        --form "manufacturer=ezagrnhqjcezoqcdtn"\
        --form "description=Laborum architecto blanditiis quisquam incidunt quibusdam voluptates cumque."\
        --form "price=19"\
        --form "stock=71"\
        --form "productable_type=App\Models\Category"\
        --form "productable_id=20"\
        --form "photos[]=@C:\Users\abdel\AppData\Local\Temp\php6C40.tmp" 

    const url = new URL(
        "http://e-commerce-api.test/api/V1/product/corrupti"
    );
    
    const headers = {
        "Content-Type": "multipart/form-data",
        "Accept": "application/json",
    };
    
    const body = new FormData();
    body.append('name', 'hbcwrjbvgepofzmjf');
    body.append('manufacturer', 'ezagrnhqjcezoqcdtn');
    body.append('description', 'Laborum architecto blanditiis quisquam incidunt quibusdam voluptates cumque.');
    body.append('price', '19');
    body.append('stock', '71');
    body.append('productable_type', 'App\Models\Category');
    body.append('productable_id', '20');
    body.append('photos[]', document.querySelector('input[name="photos[]"]').files[0]);
    
    fetch(url, {
        method: "PATCH",
        headers,
        body,
    }).then(response => response.json());

> Example response (200):

    {
        "message": "product updated successfully"
    }

> Example response (422):

    {
        "error": "validation errors"
    }


## delete a product.

> Example request:

    curl --request DELETE \
        "http://e-commerce-api.test/api/V1/product/{product\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/product/corrupti"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "DELETE",
        headers,
    }).then(response => response.json());

> Example response (200):

    {
        "message": "product deleted successfully"
    }


## add new category.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/create-new-category" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"name\": \"iure\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/create-new-category"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "name": "iure"
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
        "message": "category added successfully"
    }

> Example response (422):

    {
        "error": "validation errors"
    }


## delete an existing category.

> Example request:

    curl --request DELETE \
        "http://e-commerce-api.test/api/V1/categories/{category\_name}" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/categories/doloribus"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "DELETE",
        headers,
    }).then(response => response.json());

> Example response (200):

    {
        "message": "category removed successfully"
    }


## list all categories and subcategories with their products for the user to select which products or categories or subcategories to apply discount to

> Example request:

    curl --request GET \
        --get "http://e-commerce-api.test/api/V1/add-discount/list" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/add-discount/list"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    fetch(url, {
        method: "GET",
        headers,
    }).then(response => response.json());

> Example response (200):

    "categories": [
        {
            "id": 4,
            "name": "corrupti",
            "products": []
        },
        {
            "id": 11,
            "name": "hic",
            "products": [
                {
                    "id": 1,
                    "name": "sint",
                    "manufacturer": "Littel Ltd",
                    "price": "53.07",
                    "discount": "25.91",
                    "price_after_discount": 39.319563,
                    "stock_status": 1,
                    "photo": null
                }
            ]
        },
    ],
    "subcategories": [
        {
            "id": 1,
            "category_id": 13,
            "name": "maiores",
            "products": [
                {
                    "id": 3,
                    "name": "voluptas",
                    "manufacturer": "Ritchie-Ritchie",
                    "price": "51.88",
                    "discount": "33.62",
                    "price_after_discount": 34.437944,
                    "stock_status": 0,
                    "photo": null
                }
            ]
        },
        {
            "id": 10,
            "category_id": 32,
            "name": "dolores",
            "products": []
        },
    ]

## apply discounts to one or more products or one or more categories.

> Example request:

    curl --request POST \
        "http://e-commerce-api.test/api/V1/add-discount" \
        --header "Content-Type: application/json" \
        --header "Accept: application/json" \
        --data "{
        \"discount_percentage\": 0,
        \"valid_until\": \"2024-08-29T12:48:21\"
    }"

    const url = new URL(
        "http://e-commerce-api.test/api/V1/add-discount"
    );
    
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
    };
    
    let body = {
        "discount_percentage": 0,
        "valid_until": "2024-08-29T12:48:21"
    };
    
    fetch(url, {
        method: "POST",
        headers,
        body: JSON.stringify(body),
    }).then(response => response.json());

> Example response (200):

    {
        "message": "discount applied successfully"
    }

> Example response (422):

    {
        "error": "validation errors"
    }
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> dafc383 (Initial commit)
