-- ==========================================================
-- Omkareshwar Jyotirlinga Pilgrimage & Temple Tourism Portal
-- Sample Demo / Seed Data
-- ==========================================================

-- 1. Seed Admin
-- Default Login: admin@omkareshwar.local / Admin@Omkar2026!
-- Hash generated for password 'Admin@Omkar2026!'
INSERT INTO `admins` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Acharya Vidyadhar Sharma', 'admin@omkareshwar.local', '$2y$10$eE0Uq1i2tV.JvQh9N.4aOuTz0vX0jFqVvM5vK1Q6xO9P8Q4mN3uTu', 'superadmin', NOW(), NOW());

-- 2. Seed Settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('site_name', 'Shree Omkareshwar Jyotirlinga Darshan & Yatra Seva'),
('site_tagline', 'Official Pilgrimage Services, Vedic Pooja & Darshan Assistance on Holy Narmada'),
('contact_phone', '+91 98765 43210'),
('contact_phone_secondary', '+91 73123 45678'),
('contact_email', 'darshan@omkareshwarjyotirlinga.org'),
('office_address', 'Mandhata Island, Near Jhula Pul, Omkareshwar, Khandwa District, Madhya Pradesh - 450554, India'),
('darshan_timings', 'Morning: 05:00 AM - 12:00 PM | Afternoon: 01:15 PM - 03:30 PM | Evening: 04:30 PM - 09:30 PM'),
('announcement_banner', 'Devotees please note: Morning Mangal Aarti starts at 05:00 AM sharp. Advance booking for Shravan Maas Pooja is now open.'),
('google_maps_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3698.8094622064115!2d76.14841131542618!3d22.246419985352055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396262fe5e3b6ea9%3A0x7d6a506bf1a88b50!2sShri%20Omkareshwar%20Jyotirlinga%20Temple!5e0!3m2!1sen!2sin!4v1680000000000!5m2!1sen!2sin');

-- 3. Seed Temples
INSERT INTO `temples` (`id`, `name`, `slug`, `short_description`, `description`, `address`, `latitude`, `longitude`, `opening_time`, `closing_time`, `featured_image`, `status`, `created_at`) VALUES
(1, 
'Shree Omkareshwar Jyotirlinga Temple', 
'omkareshwar-jyotirlinga-temple', 
'The sacred 4th Jyotirlinga of Lord Shiva, situated naturally on the sacred Om-shaped Mandhata island surrounded by the holy river Narmada.', 
'The revered Omkareshwar Temple is one of the 12 sacred Jyotirlinga shrines dedicated to Lord Shiva. Situated on the Mandhata (Shivpuri) island in the Narmada River, the island itself is geographically contoured in the sacred Hindu syllable ॐ (Om). \n\nAccording to ancient Puranic scriptures, King Mandhata performed intense penance here, pleasing Lord Shiva who manifested as the Jyotirlinga. The temple features a multi-tiered Nagara architectural style with an intricately carved shikhara. Devotees take a sacred dip in the Narmada before ascending the temple steps to offer milk, bilva leaves, and sacred water. Daily rituals include Mangala Aarti at dawn, Madhyahna Bhog at noon, and the mystical Shayan Aarti at night where dice (Chausar) are set out for Lord Shiva and Goddess Parvati.', 
'Mandhata Island, Omkareshwar, Khandwa District, MP - 450554', 
22.2464199, 76.1506000, 
'05:00:00', '21:30:00', 
'temple-omkareshwar.svg', 'active', NOW()),

(2, 
'Shree Mamleshwar (Amareshwar) Temple', 
'mamleshwar-jyotirlinga-temple', 
'The ancient south-bank Jyotirlinga sanctum that completes the sacred Omkareshwar pilgrimage darshan.', 
'Mamleshwar, historically revered as Amareshwar ("Lord of Immortals"), stands gracefully on the south bank of the holy Narmada, opposite Mandhata island. Spiritual tradition dictates that the divine Jyotirlinga presence in Omkareshwar is undivided across two sanctums—Omkareshwar on the island and Mamleshwar on the mainland bank. A pilgrimage to Omkareshwar is considered spiritually fulfilled only when a devotee pays homage at both holy shrines. \n\nBuilt during the Paramara dynasty with stone masonry, Mamleshwar houses 22 lingams consecrated by the Maharani Ahilyabai Holkar. The inner sanctum reverberates with continuous Vedic chanting by resident Brahmin pandits, performing the ancient Mahimna Stotra rituals.', 
'South Bank of Narmada, Near Gomukh Ghat, Omkareshwar, MP - 450554', 
22.2435000, 76.1501000, 
'05:30:00', '21:00:00', 
'temple-mamleshwar.svg', 'active', NOW()),

(3, 
'Siddhanath Temple', 
'siddhanath-temple-mandhata', 
'A majestic 13th-century architectural masterpiece crowning the plateau of Mandhata hill.', 
'Crowning the high plateau of Mandhata island, the Siddhanath Temple represents the pinnacle of medieval central Indian temple architecture. Dating back to the 13th century, this protected monument is famed for its monumental carved stone plinth and ornately detailed monolithic pillars depicting celestial figures, elephants, and mythological motifs. \n\nPerched high above the river gorge, the temple offers panoramic vistas of the winding Narmada river and the lush Nimar valley. It is an essential stop along the holy Mandhata Parikrama route.', 
'Plateau of Mandhata Hill, Omkareshwar, MP - 450554', 
22.2482000, 76.1541000, 
'06:00:00', '18:30:00', 
'temple-siddhanath.svg', 'active', NOW()),

(4, 
'Gauri Somnath Temple', 
'gauri-somnath-temple', 
'Home to a colossal 6-foot black stone Shiva Lingam and a giant monolithic Nandi statue.', 
'The Gauri Somnath Temple is among the most imposing structures along the circumambulation path. Built in the shape of a grand multi-tiered peacock pavilion, it enshrines an enormous six-foot tall Shiva Lingam carved from glistening smooth black stone. \n\nDirectly opposite the sanctum sits a massive monolithic statue of Nandi the bull. Local folklore tells that gazing through Nandi’s ears directly into the Shiva Lingam grants deep inner clarity and releases karmic burdens.', 
'Mandhata Parikrama Path, Omkareshwar, MP - 450554', 
22.2471000, 76.1528000, 
'06:00:00', '19:00:00', 
'temple-gauri-somnath.svg', 'active', NOW()),

(5, 
'Rinmukteshwar Temple', 
'rinmukteshwar-temple-sangam', 
'A sacred sanctum at the confluence of Narmada and Kaveri where pilgrims pray for spiritual freedom from karmic debts.', 
'Situated near the divine Sangam (confluence) where the sacred river Kaveri rejoins the holy Narmada, Rinmukteshwar Temple holds extraordinary spiritual importance. The name Rinmukteshwar signifies the deity who liberates devotees from all debts—spiritual, ancestral (pitru rin), and worldly. \n\nDevotees offer yellow lentils (chana dal) upon the sacred lingam and perform special sankalp rituals here to seek financial stability, freedom from past debts, and generational peace.', 
'Sangam Ghat, Mandhata Island, Omkareshwar, MP - 450554', 
22.2498000, 76.1620000, 
'06:00:00', '19:30:00', 
'temple-rinmukteshwar.svg', 'active', NOW()),

(6, 
'24 Avatars Shrines', 
'24-avatars-shrines', 
'A sacred 11th-century cluster of Hindu and Jain shrines illustrating the harmony of ancient spiritual traditions.', 
'Located along the southern slopes of Mandhata hill, the 24 Avatars complex houses historic stone temples dating back to the 11th century. Featuring an exquisite fusion of Brahmanical and Jain temple architectures, the shrines house intricately sculptured depictions of Lord Vishnu’s avatars alongside Tirthankara icons.', 
'Southern Ridge, Mandhata Hill, Omkareshwar, MP - 450554', 
22.2450000, 76.1555000, 
'07:00:00', '18:00:00', 
'temple-avatars.svg', 'active', NOW());

-- 4. Seed Pooja Services
INSERT INTO `pooja_services` (`id`, `name`, `slug`, `description`, `benefits`, `samagri_included`, `price`, `duration`, `image`, `status`, `created_at`) VALUES
(1, 
'Maha Rudrabhishek Pooja', 
'maha-rudrabhishek-pooja', 
'The supreme Vedic ceremony invoking Lord Shiva through the recitation of Sri Rudram and continuous sacred bathing of the Jyotirlinga with Panchamrit (milk, curd, honey, ghee, sugar) and holy Narmada water.', 
'Eliminates negative energies, resolves severe planetary afflictions, promotes supreme mental serenity, prosperity, and spiritual liberation.', 
'Pure Cow Milk, Curd, Desi Ghee, Pure Honey, Bael Patra (108), Shrikhand Sandalwood, Gangajal, Narmada Jal, Janeu, Dhoop, Deep, and Fresh Lotus Flowers.', 
2501.00, '75 mins', 'pooja-rudrabhishek.svg', 'active', NOW()),

(2, 
'Laghu Rudrabhishek Pooja', 
'laghu-rudrabhishek-pooja', 
'An auspicious and focused ritual chanting of the sacred Namakam and Chamakam hymns with abhishek on the consecrated Shiva Lingam.', 
'Bestows good health, removes obstacles in career and marital life, and ensures family harmony.', 
'Panchamrit items, 51 Bael Patra, Sandalwood paste, Akshat, Flowers, Janeu, Camphor, and Sacred Narmada water.', 
1501.00, '45 mins', 'pooja-laghu-rudra.svg', 'active', NOW()),

(3, 
'Narmada Maha Aarti & Deep Daan Seva', 
'narmada-maha-aarti-deep-daan', 
'Experience the divine evening river ceremony with 108 oil lamps on the sacred ghats of Omkareshwar, accompanied by conch shells and sacred chants.', 
'Purifies the subtle mind, invites divine grace of Mother Narmada, and brings auspiciousness to the household.', 
'Large Brass Deepam, 21 Clay floating lamps with sesame oil, flower garlands, Prasad sweet, camphor, and holy river offering.', 
501.00, '30 mins', 'pooja-narmada-aarti.svg', 'active', NOW()),

(4, 
'Kaal Sarp Dosh Nivaran Pooja', 
'kaal-sarp-dosh-nivaran-pooja', 
'A comprehensive Vedic ritual performed by certified priests at the sacred Narmada Sangam to neutralize the astrological impacts of Rahu and Ketu.', 
'Overcomes repeated life setbacks, delays in marriage, chronic anxiety, and recurring negative dreams.', 
'Consecrated Silver Nag-Nagin pair, Navgrah Samidha, Havan samagri, Black sesame, Kusha grass ring, Coconuts, and vastram for priests.', 
3501.00, '120 mins', 'pooja-kaalsarp.svg', 'active', NOW()),

(5, 
'Navgrah Shanti & Mangal Dosh Nivaran', 
'navgrah-shanti-mangal-dosh', 
'Specialized Vedic peace ritual pacifying the nine planetary deities and specifically appeasing planet Mars (Mangal) on holy tirth land.', 
'Removes obstacles in matrimonial alliances, career volatility, and sudden disputes.', 
'Nine planetary grains (Navadhanya), Nine planetary colored cloths, Hawan samagri, Desi Cow Ghee, and Navgrah Yantra.', 
2100.00, '90 mins', 'pooja-navgrah.svg', 'active', NOW()),

(6, 
'Sahasranama Bilvarchana Pooja', 
'sahasranama-bilvarchana-pooja', 
'The devotional offering of 1,008 fresh tri-foliate Bilva leaves to Lord Shiva while reciting the thousand sacred names of the Supreme Divine.', 
'Grants fulfillment of deeply held righteous desires, health, longevity, and profound devotion.', 
'1,008 fresh plucked holy Bilva leaves, Sandalwood paste, Silver bilva leaf token, Dry fruits prasad, and Aarti thali.', 
1100.00, '60 mins', 'pooja-bilvarchana.svg', 'active', NOW()),

(7, 
'Mahamrityunjaya Jaap & Havan (11,000 Chants)', 
'mahamrityunjaya-jaap-havan', 
'Potent life-protecting Vedic homa and high-vibrational japa conducted by a council of 3 learned Vedic pandits.', 
'Shields against untimely dangers, revitalizes severe physical ailments, and instills fearless consciousness.', 
'Pure Guggal, Giloy twigs, Herbs, Desi Ghee (2 kg), Camphor, Havan Kund samagri, Fruits, Sweets, and Dakshina for 3 Acharyas.', 
5100.00, '180 mins', 'pooja-mahamrityunjaya.svg', 'active', NOW()),

(8, 
'VIP Darshan & Assisted Pilgrim Seva', 
'vip-darshan-assisted-pilgrim-seva', 
'Personalized pilgrimage assistance with dedicated priest escort through priority lines, guidance on temple sanctum customs, and prasadam box.', 
'Ideal for senior citizens, families with infants, and pilgrims with limited time seeking peaceful, unhurried darshan.', 
'Dedicated Pandit Coordinator, Entry facilitation, Archana thali with flowers, Coconut, and Special Mahaprasad gift box.', 
550.00, '45 mins', 'pooja-vip-darshan.svg', 'active', NOW());

-- 5. Seed Places (Attractions)
INSERT INTO `places` (`id`, `name`, `slug`, `description`, `location`, `distance_from_temple`, `image`, `status`, `created_at`) VALUES
(1, 
'Mandhata Island Om Parikrama', 
'mandhata-island-om-parikrama', 
'The sacred 7-kilometer circumambulation pathway tracing the natural perimeter of Mandhata hill. Devotees walk barefoot or shod, visiting ancient temples, cliffside caves, and river vistas along this spiritual circuit.', 
'Perimeter of Mandhata Island, Omkareshwar', 
'Starts at Main Temple Gate', 
'place-parikrama.svg', 'active', NOW()),

(2, 
'Omkareshwar Jhula Pul (Suspension Bridge)', 
'omkareshwar-jhula-pul', 
'A scenic pedestrian suspension bridge spanning the emerald green waters of the Narmada River. It connects the south bank mainland directly to the sacred island, offering breathtaking river views and cool breezes.', 
'Over River Narmada, Connecting Island & Mainland', 
'200 meters', 
'place-bridge.svg', 'active', NOW()),

(3, 
'Narmada-Kaveri Sangam Ghat', 
'narmada-kaveri-sangam-ghat', 
'The auspicious meeting point where a smaller stream of the river, traditionally reverenced as Kaveri, reunites with the main flow of holy Narmada. Bathing here is believed to cleanse deep-seated sins.', 
'Eastern tip of Mandhata Island', 
'1.8 km along parikrama path', 
'place-sangam.svg', 'active', NOW()),

(4, 
'Kajal Rani Cave & Viewpoint', 
'kajal-rani-cave', 
'A scenic historical vantage point and natural cavern offering an expansive view of the surrounding undulating hills and the Narmada river valley. A tranquil retreat for contemplation.', 
'North-Eastern Ridge of Mandhata', 
'2.2 km from Main Temple', 
'place-cave.svg', 'active', NOW()),

(5, 
'Omkareshwar Dam & Reservoir', 
'omkareshwar-dam', 
'An impressive modern engineering marvel built on the Narmada, creating a vast reservoir that reflects the surrounding hills. Boating facilities are available nearby.', 
'Upstream on River Narmada', 
'3.5 km from Town Center', 
'place-dam.svg', 'active', NOW()),

(6, 
'Adi Shankaracharya Meditation Cave', 
'adi-shankaracharya-meditation-cave', 
'The revered underground sanctum beneath the Omkareshwar temple complex where Jagadguru Adi Shankaracharya met his preceptor, Guru Govinda Bhagavatpada, and underwent sacred Vedantic initiation.', 
'Beneath Omkareshwar Temple complex', 
'Adjacent to Temple Sanctum', 
'place-shankara-cave.svg', 'active', NOW());

-- 6. Seed Hotels / Accommodations
INSERT INTO `hotels` (`id`, `name`, `slug`, `description`, `address`, `phone`, `price_range`, `image`, `amenities`, `status`, `created_at`) VALUES
(1, 
'Narmada Resort (MP Tourism)', 
'narmada-resort-mp-tourism', 
'Spacious state-run resort property perched gracefully along the river bank, featuring serene landscaped gardens, comfortable AC rooms, and multi-cuisine pure vegetarian dining.', 
'Near Omkareshwar Dam, Khandwa Road, Omkareshwar, MP', 
'+91 73128 22340', 
'₹2,800 - ₹5,500 / night', 
'hotel-narmada-resort.svg', 
'AC Rooms, Riverside Balcony, Free Wi-Fi, Pure Veg Restaurant, Ample Parking, Travel Desk', 
'active', NOW()),

(2, 
'Shree Radhe Krishna Bhakt Niwas & Ashram', 
'shree-radhe-krishna-bhakt-niwas', 
'A deeply spiritual, clean, and peaceful ashram run for visiting pilgrims. Offers simple, hygienic non-AC and AC rooms along with complimentary satvik bhojan in the morning and evening.', 
'South Bank, 300m from Mamleshwar Temple, Omkareshwar', 
'+91 94250 88712', 
'₹700 - ₹1,800 / night', 
'hotel-ashram.svg', 
'Clean Bedding, Satvik Food Facility, Hot Water, Quiet Spiritual Courtyard, Mandir on Premises', 
'active', NOW()),

(3, 
'Hotel Temple View Omkareshwar', 
'hotel-temple-view', 
'Conveniently located just 3 minutes walk from the Omkareshwar Jhula Pul. Excellent choice for families seeking quick access to early morning Mangal Aarti.', 
'Jhula Pul Approach Road, Omkareshwar, MP', 
'+91 98261 44532', 
'₹1,400 - ₹3,200 / night', 
'hotel-temple-view.svg', 
'River Views, 24-hr Front Desk, Hot Water, Room Service, Elevator, Family Suites', 
'active', NOW()),

(4, 
'Shree Gajanan Maharaj Sansthan Bhakt Niwas', 
'gajanan-maharaj-bhakt-niwas', 
'Renowned for spotless cleanliness and disciplined pilgrimage hospitality. Highly recommended for devotees seeking peaceful and cost-effective lodging.', 
'Khandwa Road, Near Bus Stand, Omkareshwar', 
'+91 73128 22105', 
'₹500 - ₹1,200 / night', 
'hotel-gajanan.svg', 
'Spotless Rooms, Mineral Water, Security, Elevator, In-house Cafeteria, Wheelchair Access', 
'active', NOW()),

(5, 
'Mandhata Heritage Retreat', 
'mandhata-heritage-retreat', 
'Boutique riverside guest house blending traditional Malwa architecture with modern amenities, offering breathtaking views of evening Narmada deep-daan.', 
'Gomukh Ghat Road, South Bank, Omkareshwar', 
'+91 97530 11984', 
'₹2,200 - ₹4,200 / night', 
'hotel-mandhata-retreat.svg', 
'River Facing Terraces, Satvik Cuisine, Meditation Deck, Free Wi-Fi, Priest Guidance Service', 
'active', NOW());

-- 7. Seed Photo Gallery
INSERT INTO `galleries` (`id`, `title`, `image`, `alt_text`, `category`, `status`, `created_at`) VALUES
(1, 'Shree Omkareshwar Shikhara at Golden Sunrise', 'gallery-temple-sunrise.svg', 'Omkareshwar temple shikhara illuminated during morning sunrise over Narmada', 'temples', 'active', NOW()),
(2, 'Sacred Narmada Evening Deep Daan Ceremony', 'gallery-aarti-lamps.svg', 'Hundreds of brass lamps and floating diyas during Narmada Aarti', 'aarti', 'active', NOW()),
(3, 'Ancient Stone Carvings of Siddhanath Shrine', 'gallery-siddhanath-carvings.svg', 'Ornate 13th century stone pillars of Siddhanath temple on Mandhata hill', 'temples', 'active', NOW()),
(4, 'Emerald Waters of Holy River Narmada at Ghats', 'gallery-narmada-river.svg', 'Serene boat crossing and ghats of river Narmada at Omkareshwar', 'river_narmada', 'active', NOW()),
(5, 'Pilgrims on the Sacred 7km Mandhata Parikrama', 'gallery-parikrama-trail.svg', 'Devotees traversing the Om-shaped circumambulation path on the sacred island', 'parikrama', 'active', NOW()),
(6, 'Vedic Priests Performing Maha Rudrabhishek', 'gallery-rudrabhishek-ritual.svg', 'Vedic priests chanting hymns during sanctum panchamrit abhishek', 'rituals', 'active', NOW()),
(7, 'Illuminated Jhula Pul Across River Narmada', 'gallery-bridge-night.svg', 'Omkareshwar suspension bridge illuminated in the evening dusk', 'river_narmada', 'active', NOW()),
(8, 'Mamleshwar Temple Sanctum and Holkar Lingams', 'gallery-mamleshwar-sanctum.svg', 'Historic Mamleshwar temple complex on the southern mainland bank', 'temples', 'active', NOW()),
(9, 'Narmada Kaveri Confluence Sangam Bathing Ghat', 'gallery-sangam-ghat.svg', 'Holy sangam ghat where pilgrims perform morning ritual bath', 'river_narmada', 'active', NOW()),
(10, 'Devotees Offering Fresh Bilva Patra to Lord Shiva', 'gallery-bilva-offering.svg', 'Sacred Bilva leaves and lotus flowers presented during Archana', 'rituals', 'active', NOW());

-- 8. Seed Blog Posts
INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `status`, `published_at`, `created_at`) VALUES
(1, 
'Complete Omkareshwar Pilgrimage Guide: Timings, Rituals & Best Travel Routes', 
'complete-omkareshwar-pilgrimage-guide', 
'Plan your sacred journey to Omkareshwar Jyotirlinga. Learn the ideal order of darshan, essential aarti schedules, and travel tips from Indore or Ujjain.', 
'Omkareshwar, cradled by the holy river Narmada in the Khandwa district of Madhya Pradesh, is among the holiest spiritual destinations of Sanatana Dharma. Revered as one of the 12 divine Jyotirlingas, it offers a rare convergence of sublime spiritual energy and breathtaking river geography.\n\n### How to Reach Omkareshwar\nThe nearest major airport is Devi Ahilyabai Holkar International Airport in Indore, approximately 78 km away (a smooth 2.5-hour drive via the Indore-Khandwa highway). Khandwa railway junction is situated 70 km south. Regular state transport buses and private taxis ply continuously from Indore, Ujjain, and Khandwa.\n\n### The Sacred Order of Darshan\n1. **Holy Snan in Narmada**: Tradition advises devotees to take a purifying dip at Nagar Ghat or Brahma Ghat before entering the sanctum.\n2. **Omkareshwar Darshan**: Cross the Jhula Pul to Mandhata island to receive the morning darshan of Lord Omkar.\n3. **Mamleshwar Darshan**: Recross to the southern mainland bank to worship at the ancient Mamleshwar (Amareshwar) Jyotirlinga. The pilgrimage is traditionally complete only when both shrines are revered.\n4. **Mandhata Parikrama**: Undertake the peaceful 7 km walk or boat tour around the island perimeter.\n\n### Daily Temple Aarti Timings\n- **Mangal Aarti**: 05:00 AM - 05:30 AM (Pure Vedic Awakening)\n- **Madhyahna Bhog**: 12:00 PM - 01:15 PM (Temple closed briefly for offerings)\n- **Sandhya Aarti**: 08:30 PM - 09:00 PM (Soul-stirring evening lamps)\n- **Shayan Aarti**: 09:00 PM - 09:30 PM (Mystical dice ritual and sanctum closure)', 
'blog-guide.svg', 1, 'published', NOW(), NOW()),

(2, 
'The Legend of Mandhata: Why Omkareshwar Island is Shaped Like the Sacred OM', 
'legend-of-mandhata-sacred-om-island', 
'Unravel the ancient Puranic story of King Mandhata, the miraculous topography of the Narmada, and the spiritual sanctity of the Omkareshwar Jyotirlinga.', 
'According to the Shiva Purana and Skanda Purana, the sacred geography of Omkareshwar is not an accident of nature, but a divine manifestation. The holy river Narmada splits into two distinct channels around a towering sandstone hill before reuniting downstream, carving an exact replica of the sacred Sanskrit glyph ॐ (OM).\n\n### King Mandhata\'s Divine Penance\nIn the Treta Yuga, the great Ikshvaku monarch King Mandhata (ancestor of Lord Rama) ruled these lands. Seeking divine solace for all living beings, the King renounced his throne and meditated on this hill for millennia. Pleased with his steadfast devotion, Lord Shiva manifested from the earth in the form of the supreme Jyotirlinga, promising to reside eternally upon this island.\n\n### The Dual Manifestation: Omkareshwar and Mamleshwar\nWhen the gods and sages gathered to celebrate the Lord’s descent, they prayed that Lord Shiva grace both the island and the southern mainland bank. In response, the cosmic Jyotirlinga manifested in two reciprocal parts: Omkareshwar ("Lord of the Om Sound") on the island, and Mamleshwar ("Lord of the Immortals") across the south river bank. Thus, two sanctums embody one indivisible divine consciousness.', 
'blog-mandhata.svg', 1, 'published', NOW(), NOW()),

(3, 
'Sacred Narmada Snan: Rules, Confluence Ghats & Spiritual Merits', 
'sacred-narmada-snan-rules-and-merits', 
'Everything you need to know about taking a sacred bath in holy River Narmada, Ghat safety, Deep Daan rituals, and spiritual significance.', 
'In ancient Vedic lore, it is believed that while a dip in the holy Ganga purifies one immediately, merely beholding the sacred waters of Mother Narmada ("Narmada Darshanat Punyam") cleanses the soul of past karmas.\n\n### Important Ghats for Pilgrims\n- **Nagar Ghat**: The main bustling bathing ghat directly facing the Jhula Pul.\n- **Koteshwar Ghat**: Situated on the south bank with peaceful steps and shallow waters.\n- **Sangam Ghat**: The holy meeting point of Narmada and the tributary Kaveri on the island.\n- **Gomukh Ghat**: Ancient historic ghat near Mamleshwar.\n\n### Recommended Spiritual Conduct\n- Bathe reverently without soap or chemicals to preserve the pristine purity of the holy river.\n- Always stay within the designated safety chains and warning markers.\n- Offer prayers facing East, offering water thrice with cupped hands (Arghya).\n- Participate in the evening floating Deep Daan to invoke serenity in the family.', 
'blog-narmada-snan.svg', 1, 'published', NOW(), NOW());

-- 9. Seed Sample Contact Messages
INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `status`, `created_at`) VALUES
(1, 'Ramesh Chandra Joshi', 'ramesh.joshi@example.com', '+91 98200 12345', 'Namaste. We are a family of 6 coming from Pune on 25th of next month. Can senior citizens get wheelchair support for the temple stairs?', 'read', NOW() - INTERVAL 2 DAY),
(2, 'Sunita Devi Agrawal', 'sunita.agrawal@example.com', '+91 94140 55678', 'Pranam. I would like to book a Maha Rudrabhishek for my husband\'s 60th birthday. Does the samagri fee include the dakshina for the Acharya?', 'unread', NOW() - INTERVAL 5 HOUR);

-- 10. Seed Sample Bookings
INSERT INTO `bookings` (`id`, `booking_number`, `user_id`, `pooja_service_id`, `booking_date`, `booking_time`, `customer_name`, `customer_phone`, `customer_email`, `amount`, `payment_status`, `booking_status`, `special_requests`, `created_at`) VALUES
(1, 'OMK-2026-8491', NULL, 1, DATE_ADD(CURRENT_DATE, INTERVAL 3 DAY), '07:30 AM', 'Vikramaditya Rao', '+91 98450 11223', 'vikram.rao@example.com', 2501.00, 'paid', 'confirmed', 'Gotra: Kashyap. Sankalp for health and prosperity of family.', NOW() - INTERVAL 1 DAY),
(2, 'OMK-2026-9214', NULL, 3, DATE_ADD(CURRENT_DATE, INTERVAL 4 DAY), '07:00 PM', 'Meenakshi Iyer', '+91 97110 33445', 'meenakshi.iyer@example.com', 501.00, 'cash_at_temple', 'pending', 'Please arrange 21 floating deepams for our evening aarti at Nagar Ghat.', NOW() - INTERVAL 6 HOUR),
(3, 'OMK-2026-6102', NULL, 8, CURRENT_DATE, '09:00 AM', 'Rajendra Prasad Verma', '+91 94251 77889', 'rajendra.verma@example.com', 550.00, 'paid', 'completed', 'Devotee has elderly mother, wheelchair assistance requested.', NOW() - INTERVAL 2 DAY);
