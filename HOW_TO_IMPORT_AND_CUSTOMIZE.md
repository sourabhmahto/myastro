# 🕉️ ओंकारेश्वर सेवा पोर्टल — पंडित श्याम गीते (पूरी सेटअप गाइड)

---

## 📌 आपके पोर्टल पर सेट किए गए विवरण (Your Configured Details)

- **शास्त्री जी का नाम:** पंडित श्याम गीते (Pandit Shyam Geete)
- **व्हाट्सएप नंबर:** **`9977557063`** (wa.me/919977557063)
- **कॉलिंग फोन नंबर:** **`+91 99775 57063`**
- **स्थान / पता:** **बामनगांव, खंडवा रोड, ओंकारेश्वर तीर्थ (म.प्र.)**

---

## 📌 भाग 1: phpMyAdmin में डेटाबेस कैसे जोड़ें (Database Import in 3 Clicks)

1. **phpMyAdmin खोलें**:
   - यदि आप लोकल XAMPP इस्तेमाल कर रहे हैं: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - या cPanel में **phpMyAdmin** पर क्लिक करें।
2. ऊपर मेनू में **"Import" (इम्पोर्ट)** टैब पर क्लिक करें।
3. **"Choose File"** बटन दबाकर यह फ़ाइल चुनें:
   📁 `d:\AppShyam\database\import_this_in_phpmyadmin.sql`
4. नीचे **"Go" / "Import"** बटन दबाएं।

✅ **डेटाबेस (`omkareshwar_db`) और सभी टेबल पंडित श्याम गीते जी के विवरण के साथ अपने आप बन जाएंगे!**

---

## 📌 भाग 2: विवरण और फोटो कहाँ बदल सकते हैं? (Where to Customize)

भविष्य में यदि आप कोई भी फोन नंबर, आरती समय या फोटो बदलना चाहें, तो केवल यह 1 फ़ाइल खोलें:

### 📁 फ़ाइल: `src/config.js`
```javascript
export const SITE_CONFIG = {
  pandit_name_hi: 'पंडित श्याम गीते (शास्त्री जी)',
  pandit_name_en: 'Pandit Shyam Geete (Shastri Ji)',
  
  phone_display: '+91 99775 57063',
  phone_dial: '+919977557063',
  whatsapp_number: '919977557063',
  
  temple_address_hi: 'स्थान: बामनगांव, खंडवा रोड, ओंकारेश्वर तीर्थ (म.प्र.)',
  temple_address_en: 'Location: Bamangaon, Khandwa Road, Omkareshwar (M.P.)',
  
  google_maps_url: 'https://maps.google.com/?q=Bamangaon,+Khandwa+Road,+Omkareshwar',
  
  images: {
    hero_banner: 'https://images.unsplash.com/...',
    rudrabhishek: 'https://images.unsplash.com/...',
    kaalsarp: 'https://images.unsplash.com/...',
    narmada_aarti: 'https://images.unsplash.com/...',
    navgrah: 'https://images.unsplash.com/...',
    mahamrityunjaya: 'https://images.unsplash.com/...',
    vip_darshan: 'https://images.unsplash.com/...'
  }
};
```

---

## 📌 भाग 3: प्रोजेक्ट को तुरंत चलाएं (How to Run)

टर्मिनल या PowerShell में `d:\AppShyam` में कमांड चलाएं:
```powershell
php -S localhost:8000
```
- **वेबसाइट:** [http://localhost:8000](http://localhost:8000)
- **शास्त्री जी एडमिन CRM:** [http://localhost:8000/#/admin](http://localhost:8000/#/admin)
  - **Email:** `admin@omkareshwar.local`
  - **Password:** `Admin@Omkar2026!`
