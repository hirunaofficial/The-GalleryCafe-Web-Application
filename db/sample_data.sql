
-- Insert Sample Data

-- Insert Users
INSERT INTO Users (Email, Phone, Password, UserType, FullName) VALUES
('admin@gallerycafe.lk', '0729215220', '$2y$10$2/YRtW7LZDGf8WC2hD2R5ueaSqi0fk5N/N41Q00HDqv9Yc0sB0dKK', 'Admin', 'Admin User'),
('staff@gallerycafe.lk', '0760266985', '$2y$10$2/YRtW7LZDGf8WC2hD2R5ueaSqi0fk5N/N41Q00HDqv9Yc0sB0dKK', 'Staff', 'Staff User One'),
('customer@gallerycafe.lk', '0112531081', '$2y$10$2/YRtW7LZDGf8WC2hD2R5ueaSqi0fk5N/N41Q00HDqv9Yc0sB0dKK', 'Customer', 'Customer One');

-- Insert Menu Items
INSERT INTO Menu (MenuName, Description, Price, CuisineType, ImageURL) VALUES
-- Starters
('Chicken Liver Pâté', 'Chicken liver pâté with garlic mushrooms and rye croute.', 1750.00, 'French', 'assets/img/menu/starters/chicken_liver_pate.jpg'),
('Olive Oil Sautéed Calamari Rings', 'Calamari rings sautéed in olive oil with spicy tartare sauce.', 2250.00, 'Mediterranean', 'assets/img/menu/starters/olive_oil_sauteed_calamari_rings.jpg'),
('Baked Crab', 'Crab meat cooked in mustard, white wine, cream on potato mash and steamed vegetables.', 2750.00, 'French', 'assets/img/menu/starters/baked_crab.jpg'),
('Smoked Salmon Terrine', 'Smoked salmon terrine with dill caper cream cheese.', 4500.00, 'French', 'assets/img/menu/starters/smoked_salmon_terrine.jpg'),
('Prawn, Lobster Avocado Cocktail', 'Prawn and lobster avocado cocktail with pomegranate.', 2950.00, 'International', 'assets/img/menu/starters/prawn_lobster_avocado_cocktail.jpg'),
('Batter Fried Whitebait', 'Batter fried whitebait with garlic aioli.', 1750.00, 'British', 'assets/img/menu/starters/batter_fried_whitebait.jpg'),
('Spanish Garlic Prawns', 'Spanish garlic prawns with parsley and fresh bread.', 2250.00, 'Spanish', 'assets/img/menu/starters/spanish_garlic_prawns.jpg'),
('Onion, Thyme and Goat Cheese Tart (v)', 'Onion, thyme and goat cheese tart.', 1750.00, 'French', 'assets/img/menu/starters/onion_thyme_goat_cheese_tart.jpg'),
('Lychee, Pear, Feta, Walnut and Pomegranate Salad (v)', 'Lychee, pear, feta, walnut and pomegranate salad.', 2450.00, 'Mediterranean', 'assets/img/menu/starters/lychee_pear_feta_walnut_pomegranate_salad.jpg'),
('Roasted Cauliflower (v)', 'Roasted cauliflower with cheese sauce, tahini and toasted cashew nuts.', 1800.00, 'International', 'assets/img/menu/starters/roasted_cauliflower.jpg'),

-- Soups
('Chicken Mulligatawny', 'Spiced chicken, vegetable, and coconut milk soup with a spoon of rice.', 1100.00, 'Indian', 'assets/img/menu/soups/chicken_mulligatawny.jpg'),
('Sri Lankan Fish Head Soup', 'Curried seer fish head in rich aromatic tomato-based soup.', 995.00, 'Sri Lankan', 'assets/img/menu/soups/sri_lankan_fish_head_soup.jpg'),
('Gazpacho (v)', 'Chilled tomato soup with lavosh.', 1450.00, 'Spanish', 'assets/img/menu/soups/gazpacho.jpg'),
('Sweet Pumpkin Soup (v)', 'Sweet pumpkin soup with basil pesto.', 1100.00, 'International', 'assets/img/menu/soups/sweet_pumpkin_soup.jpg'),
('Cream of Gotukola (v)', 'Centenella leaves & coconut cream soup with garlic toast.', 1100.00, 'Sri Lankan', 'assets/img/menu/soups/cream_of_gotukola.jpg'),

-- Salads
('Caesar Salad', 'Iceberg lettuce with a choice of bacon / spicy prawns / tandoori chicken.', 3450.00, 'Italian', 'assets/img/menu/salads/caesar_salad.jpg'),
('Chargrilled Chicken', 'Chargrilled chicken with green papaya salad.', 2250.00, 'Asian', 'assets/img/menu/salads/chargrilled_chicken.jpg'),
('Chargrilled Beef', 'Chargrilled beef with green papaya salad.', 6500.00, 'Asian', 'assets/img/menu/salads/chargrilled_beef.jpg'),
('Quail Egg Salad', 'Quail egg salad with rocket, baby spinach, anchovies and Italian dressing.', 1750.00, 'Mediterranean', 'assets/img/menu/salads/quail_egg_salad.jpg'),
('Mediterranean Salad – Chicken', 'Chicken Mediterranean salad with chickpeas, tomato, cucumber, onions, raisins, fresh basil and toasted cashew nuts with honey mustard vinaigrette.', 2600.00, 'Mediterranean', 'assets/img/menu/salads/mediterranean_salad_chicken.jpg'),
('Mediterranean Salad – Vegetarian (v)', 'Vegetarian Mediterranean salad with chickpeas, tomato, cucumber, onions, raisins, fresh basil and toasted cashew nuts with honey mustard vinaigrette.', 1700.00, 'Mediterranean', 'assets/img/menu/salads/mediterranean_salad_vegetarian.jpg'),
('Broccoli and Avocado Salad (v)', 'Broccoli and avocado salad with lime and honey vinaigrette.', 2450.00, 'International', 'assets/img/menu/salads/broccoli_avocado_salad.jpg'),
('Tomato and Mozzarella (v)', 'Tomato and mozzarella salad with fresh basil pesto.', 2500.00, 'Italian', 'assets/img/menu/salads/tomato_mozzarella.jpg'),
('Mixed Salad', 'Mixed salad with passion fruit and balsamic dressing.', 1500.00, 'International', 'assets/img/menu/salads/mixed_salad.jpg'),

-- Mains - Meat
('Paradise Road Super Burger', 'Beef burger with bacon, fried egg, cheddar and parmesan cheese, caramelised onions, lettuce, mayonnaise and hand cut fries.', 3600.00, 'American', 'assets/img/menu/mains/paradise_road_super_burger.jpg'),
('Malacca Fried Rice', 'Malacca fried rice with prawns, pork, and fried egg.', 3500.00, 'Malaysian', 'assets/img/menu/mains/malacca_fried_rice.jpg'),
('Mediterranean Sizzling Beef Fillet', 'Mediterranean sizzling beef fillet with green peppercorns, rosemary and choice of hand cut fries / potato mash / bread.', 9500.00, 'Mediterranean', 'assets/img/menu/mains/mediterranean_sizzling_beef_fillet.jpg'),
('Grilled Sirloin Steak', 'Grilled sirloin steak with choice of potato mash / hand cut fries, green salad / steamed vegetables, béarnaise / hollandaise / green pepper / garlic butter sauce.', 9500.00, 'International', 'assets/img/menu/mains/grilled_sirloin_steak.jpg'),
('Grilled Fillet Steak', 'Grilled fillet steak with choice of potato mash / hand cut fries, green salad / steamed vegetables, béarnaise / hollandaise / green pepper / garlic butter sauce.', 12000.00, 'International', 'assets/img/menu/mains/grilled_fillet_steak.jpg'),
('Rack of Lamb', 'Rack of lamb with crushed baby potatoes and salsa verde.', 14500.00, 'International', 'assets/img/menu/mains/rack_of_lamb.jpg'),
('Grilled Lamb Cutlets', 'Grilled lamb cutlets with choice of potato mash / hand cut fries, green salad / steamed vegetables, béarnaise / hollandaise / green pepper / garlic butter sauce.', 14000.00, 'International', 'assets/img/menu/mains/grilled_lamb_cutlets.jpg'),
('Pan-fried Calves Liver', 'Pan-fried calves liver in red wine sauce with potato mash, crispy bacon, and apple sauce.', 3500.00, 'British', 'assets/img/menu/mains/pan_fried_calves_liver.jpg'),
('Parmesan-crusted Pork Schnitzel', 'Parmesan-crusted pork schnitzel with creamy fettuccine and Goan vindaloo sauce.', 2750.00, 'German', 'assets/img/menu/mains/parmesan_crusted_pork_schnitzel.jpg'),
('Roast Pork with Mustard Sauce', 'Roast pork with mustard sauce, potato mash, steamed vegetables, apple sauce and crackling.', 3750.00, 'International', 'assets/img/menu/mains/roast_pork_with_mustard_sauce.jpg'),

-- Mains - Poultry
('Chicken Piccata', 'Chicken piccata with lemon caper sauce and spaghetti.', 3500.00, 'Italian', 'assets/img/menu/mains/chicken_piccata.jpg'),
('Chicken Kiev', 'Chicken Kiev with potato mash and steamed vegetables.', 3500.00, 'Russian', 'assets/img/menu/mains/chicken_kiev.jpg'),
('Roast Chicken', 'Roast chicken with potato mash, steamed vegetables, and gravy.', 3500.00, 'French', 'assets/img/menu/mains/roast_chicken.jpg'),
('Chicken Cordon Bleu', 'Chicken Cordon Bleu with potato mash and steamed vegetables.', 3500.00, 'French', 'assets/img/menu/mains/chicken_cordon_bleu.jpg'),

-- Sweets
('Chocolate Fondant', 'Chocolate fondant.', 1200.00, 'French', 'assets/img/menu/sweets/chocolate_fondant.jpg'),
('Apple Crumble', 'Apple crumble.', 1200.00, 'British', 'assets/img/menu/sweets/apple_crumble.jpg'),
('Tiramisu', 'Tiramisu.', 1200.00, 'Italian', 'assets/img/menu/sweets/tiramisu.jpg'),
('Crème Brûlée', 'Crème brûlée.', 1200.00, 'French', 'assets/img/menu/sweets/creme_brulee.jpg'),
('Profiteroles', 'Profiteroles.', 1200.00, 'French', 'assets/img/menu/sweets/profiteroles.jpg'),
('Frozen Nougat', 'Frozen nougat.', 1200.00, 'French', 'assets/img/menu/sweets/frozen_nougat.jpg'),
('Orange & Ginger Bread Pudding', 'Orange & ginger bread pudding with crème anglaise.', 1200.00, 'International', 'assets/img/menu/sweets/orange_ginger_bread_pudding.jpg'),

-- Cold Beverages
('Ginger Beer', 'Ginger beer.', 800.00, 'International', 'assets/img/menu/beverages/ginger_beer.jpg'),
('Soft Drinks', 'Cola / Lemonade / Tonic Water.', 800.00, 'International', 'assets/img/menu/beverages/soft_drinks.jpg'),
('Fresh Juices', 'Papaya / Lime / Watermelon / Orange / Pineapple.', 850.00, 'International', 'assets/img/menu/beverages/fresh_juices.jpg'),
('Chilled Tea', 'Peach / Lime / Lemon.', 850.00, 'International', 'assets/img/menu/beverages/chilled_tea.jpg'),
('Seasonal Fruit Mocktail', 'Seasonal fruit mocktail.', 1450.00, 'International', 'assets/img/menu/beverages/seasonal_fruit_mocktail.jpg'),
('Mango and Passion Fruit Smoothie', 'Mango and passion fruit smoothie.', 1450.00, 'International', 'assets/img/menu/beverages/mango_passion_fruit_smoothie.jpg'),
('Seasonal Fruit Smoothies', 'Seasonal fruit smoothies.', 1200.00, 'International', 'assets/img/menu/beverages/seasonal_fruit_smoothies.jpg'),
('King Coconut Water', 'King coconut water.', 450.00, 'Sri Lankan', 'assets/img/menu/beverages/king_coconut_water.jpg'),

-- Hot Beverages
('Hot Tea', 'Ceylon Tea / Ceylon Black Tea / Lemon Tea / Earl Grey / Green Tea / Cardamom Tea / Camomile / Peppermint / Ginger.', 600.00, 'International', 'assets/img/menu/beverages/hot_tea.jpg'),
('Espresso', 'Espresso.', 800.00, 'International', 'assets/img/menu/beverages/espresso.jpg'),
('Coffee', 'Coffee.', 800.00, 'International', 'assets/img/menu/beverages/coffee.jpg'),
('Cappuccino', 'Cappuccino.', 1200.00, 'International', 'assets/img/menu/beverages/cappuccino.jpg'),
('Latte', 'Latte.', 1200.00, 'International', 'assets/img/menu/beverages/latte.jpg'),
('Iced Coffee', 'Iced coffee.', 1200.00, 'International', 'assets/img/menu/beverages/iced_coffee.jpg'),
('Café Latté', 'Café latté.', 1350.00, 'International', 'assets/img/menu/beverages/cafe_latte.jpg'),
('Café Brulot', 'Café Brulot.', 2950.00, 'International', 'assets/img/menu/beverages/cafe_brulot.jpg'),
('Vanilla Ice Cream', 'Vanilla ice cream.', 300.00, 'International', 'assets/img/menu/beverages/vanilla_ice_cream.jpg'),

-- Milkshakes
('Vanilla Milkshake', 'Vanilla milkshake.', 1500.00, 'International', 'assets/img/menu/beverages/vanilla_milkshake.jpg'),
('Chocolate Milkshake', 'Chocolate milkshake.', 1500.00, 'International', 'assets/img/menu/beverages/chocolate_milkshake.jpg'),
('Strawberry Milkshake', 'Strawberry milkshake.', 1500.00, 'International', 'assets/img/menu/beverages/strawberry_milkshake.jpg');

-- Insert Special Events
INSERT INTO SpecialEvents (EventName, Description, EventDate, ImageURL) VALUES
('Valentine\'s Day Special', 'Enjoy a romantic dinner with your loved one on Valentine\'s Day at our special event.', '2024-02-14 19:00:00', 'assets/img/events/valentines_day.jpg'),
('Easter Brunch', 'Join us for a delightful Easter brunch featuring a variety of delicious dishes and treats.', '2024-03-31 11:00:00', 'assets/img/events/easter_brunch.jpg'),
('Summer BBQ Bash', 'Have a blast at our summer BBQ bash with tasty food, drinks, and great company.', '2024-06-21 16:00:00', 'assets/img/events/summer_bbq.jpg'),
('Halloween Costume Party', 'Dress up and join our spooky Halloween costume party with fun activities and contests.', '2024-10-31 18:00:00', 'assets/img/events/halloween.jpg'),
('Thanksgiving Dinner', 'Celebrate Thanksgiving with a traditional dinner full of delicious dishes and festive cheer.', '2024-11-28 19:00:00', 'assets/img/events/thanksgiving.jpg'),
('Christmas Eve Dinner', 'Enjoy a festive Christmas Eve dinner with family and friends at our cozy restaurant.', '2024-12-24 19:00:00', 'assets/img/events/christmas_eve.jpg'),
('New Year Party', 'Celebrate the new year with a spectacular party full of fun and excitement!', '2024-12-31 20:00:00', 'assets/img/events/new_year.jpg');

-- Insert Promotions
INSERT INTO Promotions (PromotionName, Description, StartDate, EndDate, ImageURL) VALUES
('New Year Discount', 'Kick off the year with special discounts.', '2024-01-01', '2024-01-31', 'assets/img/promotions/new_year_discount.jpg'),
('Valentine\'s Day Offer', 'Celebrate love with our special Valentine\'s Day offers.', '2024-02-01', '2024-02-14', 'assets/img/promotions/valentines_offer.jpg'),
('Spring Savings', 'Enjoy amazing spring savings on select menu items.', '2024-03-01', '2024-03-31', 'assets/img/promotions/spring_savings.jpg'),
('Easter Specials', 'Easter-themed menu items and discounts.', '2024-04-01', '2024-04-30', 'assets/img/promotions/easter_specials.jpg'),
('Mother\'s Day Brunch', 'Special brunch menu to celebrate Mother\'s Day.', '2024-05-01', '2024-05-12', 'assets/img/promotions/mothers_day_brunch.jpg'),
('Father\'s Day Feast', 'Treat Dad to our Father\'s Day feast.', '2024-06-01', '2024-06-16', 'assets/img/promotions/fathers_day_feast.jpg'),
('Summer Special', 'Enjoy our summer special menu.', '2024-07-01', '2024-08-31', 'assets/img/promotions/summer_special.jpg'),
('Back to School', 'Special discounts for students and families.', '2024-09-01', '2024-09-30', 'assets/img/promotions/back_to_school.jpg'),
('Halloween Treats', 'Spooky discounts and Halloween-themed menu items.', '2024-10-01', '2024-10-31', 'assets/img/promotions/halloween_treats.jpg'),
('Thanksgiving Offer', 'Special Thanksgiving menu and discounts.', '2024-11-01', '2024-11-30', 'assets/img/promotions/thanksgiving_offer.jpg'),
('Holiday Discount', 'Get discounts during the holiday season.', '2024-12-01', '2024-12-31', 'assets/img/promotions/holiday_discount.jpg');

-- Sample data for TableCapacities
INSERT INTO TableCapacities (Capacity, AvailabilityStatus) VALUES 
(2, 'Available'), 
(2, 'Available'), 
(2, 'Available'), 
(2, 'Available'), 
(2, 'Available'), 
(4, 'Available'), 
(4, 'Available'), 
(4, 'Available'), 
(4, 'Available'), 
(4, 'Available'), 
(4, 'Available'), 
(6, 'Available'), 
(6, 'Available'), 
(6, 'Available'), 
(6, 'Available'), 
(8, 'Available'), 
(8, 'Available'), 
(8, 'Available'), 
(8, 'Available'), 
(8, 'Available');

-- Sample data for ParkingAvailability
INSERT INTO ParkingAvailability (ParkingSpotNumber, AvailabilityStatus) VALUES 
('A1', 'Available'), 
('A2', 'Available'), 
('A3', 'Available'), 
('A4', 'Available'), 
('A5', 'Available'), 
('A6', 'Available'), 
('A7', 'Available'), 
('A8', 'Available'), 
('A9', 'Available'), 
('A10', 'Available'), 
('A11', 'Available'), 
('A12', 'Available'), 
('A13', 'Available'), 
('A14', 'Available'), 
('A15', 'Available'), 
('A16', 'Available'), 
('A17', 'Available'), 
('A18', 'Available'), 
('A19', 'Available'), 
('A20', 'Available');