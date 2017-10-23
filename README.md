# OnlineShoppingProject_PHP_XHR_XSL

Online Shopping Project, using following technologies Javascript, XHR, PHP, XML and XSL
This project is all about maintaing the Simple Buy Online Website.

Project Breif.

1) Site Map - Contains all the links to the pages
  1) Store Manager Login
      Where Manager can view all the goods present in the repository      
  2) Customer Sign-Up
      Everytime user signs up, this entry will be loaded into a xml file.
  3) Customer Log In
      Everytime user logs in, it checks for the customer xml file for entries.
        if registered, 
          if correct password
            user will be redirected to Shopping Catalog and Shopping Cart options in the same page.
          else 
            Invalid Passoword message.
        else
          user will be intimated to register.
  4) Shopping Catalog Table
      has following fields.
        1) Item Name, 
        2) Description, 
        3) Item Price, 
        4) Item Quantity,
        5) Add to Cart Button
  5) Shopping Catalog
        has following fields.
          1) Item Name, 
          2) Item Price,  
          4) Item Quantity 
          5) Remove from Cart Button                   
  6) Processing Page
      Specific to Manger to maintain the goods information.
  7) Listing
      Can add the item to goods xml or shopping catalog.
  8) Logout
      Thank you message for user saying visit again.
   
   Note: All the fields are dynamic and working as per user actions.
   
   Scope for Improvement :: I haven't used session management using PHP. Anyone can always use it to improvise.
   
   
   
   

