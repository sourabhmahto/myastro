-- =========================================================================
-- Omkareshwar Jyotirlinga Pooja & Astro Seva - Seed Data (Bilingual)
-- Configured for: Pandit Shyam Geete (पंडित श्याम गीते)
-- =========================================================================

-- 1. Seed Categories
INSERT INTO `categories` (`id`, `slug`, `name_en`, `name_hi`, `display_order`, `is_active`) VALUES
(1, 'pooja', 'Vedic Pooja & Abhishek', 'वैदिक पूजा एवं अभिषेक', 1, 1),
(2, 'astro', 'Astrology & Dosh Nivaran', 'ज्योतिष एवं दोष निवारण', 2, 1),
(3, 'vastu', 'Vastu Shanti & Hawan', 'वास्तु शांति एवं महाहवन', 3, 1),
(4, 'sanskar', 'Spiritual Sanskar & Seva', 'धार्मिक संस्कार एवं सेवा', 4, 1)
ON DUPLICATE KEY UPDATE `name_en`=VALUES(`name_en`), `name_hi`=VALUES(`name_hi`), `display_order`=VALUES(`display_order`);

-- 2. Seed Poojas
INSERT INTO `poojas` (`id`, `category_id`, `name_en`, `name_hi`, `description_en`, `description_hi`, `image_url`, `display_order`, `is_active`) VALUES
(1, 1, 
'Maha Rudrabhishek Pooja', 
'महा रुद्राभिषेक पूजा', 
'Supreme Vedic ceremony with continuous sacred bathing of Omkareshwar Jyotirlinga using Panchamrit (Milk, Curd, Ghee, Honey, Sugar) and Holy Narmada Jal while chanting Sri Rudram.', 
'भगवान ओंकारेश्वर ज्योतिर्लिंग का पंचामृत (दूध, दही, घी, शहद, शक्कर) एवं पवित्र नर्मदा जल से श्री रुद्रम मंत्रोच्चार सहित महाअभिषेक। मानसिक शांति, सुख-समृद्धि एवं ग्रह शांति हेतु परम कल्याणकारी।', 
'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80', 1, 1),

(2, 2, 
'Kaal Sarp Dosh Nivaran Anushthan', 
'कालसर्प दोष निवारण महाअनुष्ठान', 
'Potent astrological Vedic ritual performed by certified Pandits at the holy Narmada-Kaveri Sangam with consecrated silver Nag-Nagin to remove Rahu-Ketu hurdles.', 
'पवित्र नर्मदा-कावेरी संगम पर वैदिक ब्राह्मणों द्वारा चांदी के नाग-नागिन जोड़े के साथ राहु-केतु जनित कालसर्प दोष की विशेष शांति पूजा। जीवन की बाधाओं और व्यापारिक रुकावटों से मुक्ति।', 
'https://images.unsplash.com/photo-1544816155-12df9643f363?w=800&auto=format&fit=crop&q=80', 2, 1),

(3, 1, 
'Narmada Maha Aarti & Deep Daan Seva', 
'नर्मदा महाआरती एवं 108 दीपदान सेवा', 
'Enchanting evening river ceremony with 108 brass lamps and floating diyas on the sacred ghats of Omkareshwar to invite Mother Narmada\'s eternal blessings.', 
'मां नर्मदा के पवित्र घाट पर 108 पीतल के दीपकों एवं पुष्पों से महाआरती एवं नदी में प्रज्वलित दीपदान सेवा। पारिवारिक सुख, सौभाग्य और दिव्य शांति की प्राप्ति।', 
'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=800&auto=format&fit=crop&q=80', 3, 1),

(4, 2, 
'Navgrah Shanti & Mangal Dosh Nivaran', 
'नवग्रह शांति एवं मंगल दोष निवारण', 
'Specialized Vedic peace ritual pacifying the nine planetary deities and specifically alleviating Mangal (Mars) dosh for marriage and career stability.', 
'नवग्रहों की प्रसन्नता एवं विवाह, स्वास्थ्य, व्यापार में मंगल दोष के नकारात्मक प्रभावों को शांत करने हेतु नवधान्य एवं विशेष समिधा से हवनात्मक पूजा।', 
'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=800&auto=format&fit=crop&q=80', 4, 1),

(5, 1, 
'Mahamrityunjaya Jaap & Hawan (11,000 Chants)', 
'महामृत्युंजय जाप एवं महाहवन (11,000 मंत्र)', 
'High-vibrational life-protecting Vedic homa conducted by a council of learned Acharyas for longevity, disease elimination, and supreme divine protection.', 
'गंभीर व्याधियों, अकाल भय से मुक्ति एवं दीर्घायु के लिए 3 वैदिक आचार्यों द्वारा 11,000 महामृत्युंजय मंत्रों का जाप, दशांश हवन एवं पूर्णाहुति।', 
'https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?w=800&auto=format&fit=crop&q=80', 5, 1),

(6, 4, 
'VIP Darshan & Assisted Pilgrim Sankalp', 
'वीआईपी दर्शन एवं व्यक्तिगत संकल्प सेवा', 
'Personalized pilgrimage assistance with dedicated priest escort through priority lines, guidance on temple customs, and sanctified Mahaprasadam box.', 
'वरिष्ठ नागरिकों एवं परिवारों के लिए सुगम दर्शन, व्यक्तिगत गोत्र संकल्प, मंदिर दर्शन मार्गदर्शन तथा पवित्र महाप्रसाद वितरण सेवा।', 
'https://images.unsplash.com/photo-1567157577867-05ccb1388e66?w=800&auto=format&fit=crop&q=80', 6, 1)
ON DUPLICATE KEY UPDATE `name_en`=VALUES(`name_en`), `name_hi`=VALUES(`name_hi`), `category_id`=VALUES(`category_id`);

-- 3. Seed Pooja Variations
INSERT INTO `pooja_variations` (`id`, `pooja_id`, `title_en`, `title_hi`, `price`, `display_order`) VALUES
(1, 1, 'Simple Abhishek (1 Pandit + Gangajal/Milk)', 'साधारण अभिषेक (1 पंडित + जल/दूध)', 1100.00, 1),
(2, 1, 'Standard Panchamrit (1 Pandit + Complete Samagri + Belpatra)', 'मानक पंचामृत (1 पंडित + संपूर्ण पूजन सामग्री + बेलपत्र)', 2501.00, 2),
(3, 1, 'Grand 5-Priest Laghu Rudra (5 Priests + Hawan + Mahaprasad)', 'भव्य 5-ब्राह्मण लघु रुद्र (5 आचार्य + विशेष हवन + महाप्रसाद)', 5100.00, 3),

(4, 2, 'Standard Confluence Pooja (Silver Nag-Nagin Pair)', 'मानक संगम पूजा (चांदी का नाग-नागिन जोड़ा)', 3501.00, 1),
(5, 2, 'Sampoorna Maha Nivaran (3 Priests + Rudra Hawan + Silver Nag)', 'संपूर्ण महा निवारण (3 आचार्य + रुद्र हवन + चांदी का नाग)', 7500.00, 2),

(6, 3, '21 Floating Deep Daan & Aarti Thali', '21 दीपदान एवं आरती थाली', 501.00, 1),
(7, 3, '108 Maha Deep Daan with Family Sankalp', '108 महादीपदान एवं सपरिवार संकल्प', 1501.00, 2),

(8, 4, 'Standard Navgrah Shanti (1 Priest + Navadhanya)', 'मानक नवग्रह शांति (1 पंडित + नवधान्य)', 2100.00, 1),
(9, 4, 'Maha Mangal Dosh Nivaran (3 Priests + Hawan + Yantra)', 'महा मंगल दोष निवारण (3 आचार्य + हवन + अभिमंत्रित यंत्र)', 4500.00, 2),

(10, 5, '11,000 Japa + Dashansh Hawan (3 Priests, 1 Day)', '11,000 जाप + दशांश हवन (3 आचार्य, 1 दिवस)', 5100.00, 1),
(11, 5, '21,000 Japa + Maha Hawan (5 Priests, 2 Days)', '21,000 जाप + महाहवन (5 आचार्य, 2 दिवस)', 11000.00, 2),

(12, 6, 'Single Devotee Priority Escort', 'एकल श्रद्धालु प्राथमिकता दर्शन', 550.00, 1),
(13, 6, 'Family VIP Package (Up to 4 Persons + Mahaprasad)', 'पारिवारिक वीआईपी पैकेज (4 सदस्य तक + महाप्रसाद)', 1500.00, 2)
ON DUPLICATE KEY UPDATE `title_en`=VALUES(`title_en`), `title_hi`=VALUES(`title_hi`), `price`=VALUES(`price`);

-- 4. Seed Blogs
INSERT INTO `blogs` (`id`, `title_en`, `title_hi`, `content_en`, `content_hi`, `image_url`, `is_published`, `created_at`) VALUES
(1, 
'Complete Omkareshwar Pilgrimage Guide: Rituals, Darshan & Timings', 
'संपूर्ण ओंकारेश्वर यात्रा मार्गदर्शन: पूजा विधि, दर्शन एवं समय सारणी', 
'Omkareshwar Jyotirlinga, situated on the sacred Mandhata island surrounded by holy River Narmada, is one of the twelve divine Jyotirlingas. Pilgrims should begin their sacred yatra with a holy snan at Nagar Ghat before proceeding to Lord Omkareshwar and Mamleshwar shrines.\n\n### Daily Temple Aarti Timings:\n- **Mangal Aarti**: 05:00 AM - 05:30 AM\n- **Madhyahna Bhog**: 12:00 PM - 01:15 PM\n- **Sandhya Aarti**: 08:30 PM - 09:00 PM\n- **Shayan Aarti (Dice Ritual)**: 09:00 PM - 09:30 PM', 
'पवित्र नर्मदा नदी के पावन तट पर स्थित ओंकारेश्वर ज्योतिर्लिंग भगवान शिव के 12 ज्योतिर्लिंगों में चतुर्थ स्थान रखता है। मान्यता है कि यहां मां नर्मदा स्वयं ॐ के आकार में बहती हैं।\n\n### दैनिक आरती समय सारणी:\n- **मंगल आरती**: प्रातः 05:00 - 05:30 बजे\n- **मध्याह्न भोग**: दोपहर 12:00 - 01:15 बजे\n- **संध्या आरती**: रात्रि 08:30 - 09:00 बजे\n- **शयन आरती (चौपड़ पासा विधान)**: रात्रि 09:00 - 09:30 बजे', 
'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80', 1, NOW()),

(2, 
'Why Omkareshwar and Mamleshwar Are Both Worshipped Together', 
'ओंकारेश्वर एवं ममलेश्वर दोनों के दर्शन क्यों अनिवार्य हैं?', 
'According to the Shiva Purana, Lord Shiva manifested in two reciprocal sanctums upon King Mandhata\'s penance: Omkareshwar on the island and Mamleshwar (Amareshwar) on the south mainland bank. A pilgrimage to Omkareshwar is considered spiritually fulfilled only when a devotee pays homage at both shrines.', 
'शिव पुराण के अनुसार राजा मान्धाता की घोर तपस्या से प्रसन्न होकर भगवान शिव दो स्वरूपों में प्रकट हुए: मान्धाता द्वीप पर ओंकारेश्वर तथा दक्षिण तट पर ममलेश्वर (अमलेश्वर)। मान्यता है कि दोनों ज्योतिर्लिंगों के दर्शन के उपरांत ही तीर्थयात्रा का पूर्ण फल प्राप्त होता है।', 
'https://images.unsplash.com/photo-1544816155-12df9643f363?w=800&auto=format&fit=crop&q=80', 1, NOW() - INTERVAL 1 DAY),

(3, 
'Sacred Merits of Narmada Snan and Deep Daan at the Confluence', 
'नर्मदा स्नान एवं संगम पर दीपदान का आध्यात्मिक महात्म्य', 
'Ancient scriptures state: "Narmada Darshanat Punyam, Ganga Snanat Tu Muktaye" - simply beholding holy Mother Narmada purifies the soul of past karmas. Evening Deep Daan with 108 oil lamps invokes divine harmony in the household.', 
'शास्त्रों में उल्लेख है कि केवल नर्मदा जी के दर्शन मात्र से प्राणी समस्त पापों से मुक्त हो जाता है। संगम तट पर संध्या समय दीपदान करने से पितृ शांति, स्वास्थ्य लाभ एवं परिवार में अखंड समृद्धि की प्राप्ति होती है।', 
'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?w=800&auto=format&fit=crop&q=80', 1, NOW() - INTERVAL 2 DAY)
ON DUPLICATE KEY UPDATE `title_en`=VALUES(`title_en`), `title_hi`=VALUES(`title_hi`);

-- 5. Seed Devotee Bookings
INSERT INTO `devotees_bookings` (`id`, `user_id`, `full_name`, `phone`, `whatsapp_number`, `gotra`, `nakshatra`, `pooja_id`, `variation_id`, `preferred_date`, `special_wishes`, `status`, `admin_notes`, `created_at`) VALUES
(1, NULL, 'Vikramaditya Rao', '+919845011223', '+919845011223', 'Kashyap', 'Rohini', 1, 2, DATE_ADD(CURRENT_DATE, INTERVAL 2 DAY), 'Family health and career prosperity sankalp.', 'Sankalp Done', 'Pandit Shyam Geete assigned. Samagri arranged.', NOW() - INTERVAL 1 DAY),
(2, NULL, 'Meenakshi Agrawal', '+919711033445', '+919711033445', 'Garg', 'Ashwini', 2, 4, DATE_ADD(CURRENT_DATE, INTERVAL 4 DAY), 'Kaal sarp dosh nivaran for son.', 'Pending', 'Devotee requested morning 7:30 AM slot at Sangam Ghat.', NOW() - INTERVAL 4 HOUR);

-- 6. Admin User (Pandit Shyam Geete)
INSERT INTO `users_v2` (`id`, `name`, `phone`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Pandit Shyam Geete (Shastri Ji)', '+919977557063', 'admin@omkareshwar.local', '$2y$10$eE0Uq1i2tV.JvQh9N.4aOuTz0vX0jFqVvM5vK1Q6xO9P8Q4mN3uTu', 'admin', NOW())
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `role`=VALUES(`role`);
