/**
 * Omkareshwar Jyotirlinga Pooja & Astro Seva - Modern Vue 3 Application
 * Comprehensive Admin CMS & Secured Portal for Pandit Shyam Geete
 */

import { createApp, ref, reactive, computed, onMounted, watch } from 'vue';
import { SITE_CONFIG } from './config.js';

// ---------------------------------------------------------------------------
// Translations Dictionary (Bilingual: Hindi & English)
// ---------------------------------------------------------------------------
const i18n = {
  hi: {
    site_title: 'श्री ओंकारेश्वर ज्योतिर्लिंग',
    site_tagline: 'पंडित श्याम गीते • वैदिक पूजा एवं ज्योतिष सेवा',
    nav_home: 'मुख्य पृष्ठ',
    nav_pooja: 'पूजा सेवाएँ',
    nav_pandits: 'विद्वान पुरोहित',
    nav_blogs: 'आध्यात्मिक ब्लॉग',
    nav_contact: 'संपर्क करें',
    nav_admin: 'व्यवस्थापक',
    lang_toggle: 'English',
    hero_badge: 'पवित्र ज्योतिर्लिंग तीर्थ • चतुर्थ ज्योतिर्लिंग',
    hero_title_1: 'श्री ओंकारेश्वर ज्योतिर्लिंग',
    hero_title_2: 'वैदिक पूजा एवं अनुष्ठान सेवा',
    hero_desc: 'पवित्र नर्मदा तट स्थित श्री ओंकारेश्वर तीर्थ पर पूज्य पंडित श्याम गीते (शास्त्री जी) द्वारा शास्त्रोक्त रुद्राभिषेक, कालसर्प दोष, नवग्रह शांति एवं महामृत्युंजय अनुष्ठान वैदिक विधि-विधान से संपन्न करवाएं।',
    cta_book_pooja: 'पूजा सेवाएँ देखें',
    cta_whatsapp_shastri: 'शास्त्री जी से संपर्क',
    aarti_timings_badge: SITE_CONFIG.aarti_timings_hi,
    cat_all: 'सभी सेवाएँ',
    starting_from: 'आरंभिक दक्षिणा',
    select_variation: 'पैकेज चुनें / संकल्प लें',
    whatsapp_enquiry: 'व्हाट्सएप पूछताछ',
    custom_anushthan_title: 'विशेष अनुष्ठान या व्यक्तिगत पूजा?',
    custom_anushthan_desc: 'यदि आप जन्म कुंडली अनुसार विशेष शांति, नवग्रह दोष निवारण या महामृत्युंजय अनुष्ठान चाहते हैं, तो सीधे पंडित श्याम गीते जी से निःशुल्क परामर्श प्राप्त करें।',
    custom_anushthan_btn: 'शास्त्री जी से सीधे बात करें',
    daily_blogs_title: 'दैनिक पंचांग एवं आध्यात्मिक लेख',
    daily_blogs_sub: 'ओंकारेश्वर ज्योतिर्लिंग के दर्शन, त्यौहार-पर्व की तिथियां एवं दैनिक धार्मिक मार्गदर्शन',
    read_more: 'पूरा पढ़ें',
    close: 'बंद करें',
    
    // Pandits Section
    pandits_title: 'तीर्थ पुरोहित एवं आचार्य मंडल',
    pandits_sub: 'ओंकारेश्वर तीर्थ के प्रमाणित, वेद-पाठी एवं शास्त्रोक्त आचार्य',
    experience_suffix: 'वर्ष अनुभव',
    reviews_count_suffix: 'यजमानों का विश्वास',
    verified_acharya: 'प्रमाणित वैदिक आचार्य',
    consult_pandit: 'परामर्श हेतु व्हाट्सएप करें',

    // Universal Trust & Contact
    trust_section_title: 'तीर्थ सेवा की प्रामाणिकता एवं विश्वास',
    trust_section_sub: 'पारंपरिक वैदिक परंपरा, शास्त्रोक्त संकल्प एवं निष्ठापूर्वक सेवा',
    trust_badge_1_title: 'शुद्ध शास्त्रोक्त संकल्प',
    trust_badge_1_desc: 'आपके गोत्र एवं नामोच्चार के साथ प्रामाणिक वैदिक पूजा',
    trust_badge_2_title: 'प्रमाणित तीर्थ पुरोहित',
    trust_badge_2_desc: 'पंडित श्याम गीते व ओंकारेश्वर के अनुभवी आचार्य मंडल',
    trust_badge_3_title: 'पवित्र नर्मदा अभिषेक',
    trust_badge_3_desc: 'माँ नर्मदा के जल एवं पवित्र भस्म से संपन्न पूजन',
    trust_badge_4_title: 'लाइव/वीडियो प्रमाण',
    trust_badge_4_desc: 'पूजा का वीडियो व संकल्प क्लिप व्हाट्सएप पर प्रेषित',

    hotline_title: 'पंडित श्याम गीते - हेल्पलाइन एवं परामर्श',
    hotline_sub: 'पूजा संकल्प, मुहूर्त एवं तीर्थ मार्गदर्शन हेतु 24x7 उपलब्ध',
    call_now: 'कॉल करें',
    chat_whatsapp: 'व्हाट्सएप चैट',
    temple_location: SITE_CONFIG.temple_address_hi,
    get_directions: 'गूगल मैप लोकेशन देखें',
    quick_inquiry_title: 'त्वरित पूजा बुकिंग / संकल्प फॉर्म',
    form_full_name: 'यजमान का पूरा नाम *',
    form_phone: 'संपर्क मोबाइल नंबर *',
    form_whatsapp: 'व्हाट्सएप नंबर *',
    form_gotra: 'गोत्र (यदि ज्ञात न हो तो कश्यप)',
    form_nakshatra: 'जन्म नक्षत्र / राशि',
    form_date: 'पूजा की इच्छित तिथि *',
    form_wishes: 'विशेष मनोकामना / संदेश',
    form_submit: 'पूजा बुकिंग सुरक्षित करें',
    submitting: 'कृपया प्रतीक्षा करें...',
    variation_modal_title: 'पूजा पैकेज एवं दक्षिणा विवरण',
    select_package_btn: 'यह पैकेज चुनें और संकल्प लें',

    // Devotee CRM / Admin
    admin_portal_title: 'पंडित श्याम गीते - प्रबंधन पोर्टल',
    tab_crm: 'यजमान CRM (Bookings)',
    tab_poojas: 'पूजा सेवाएँ व पैकेज',
    tab_pandits: 'पुरोहित मंडल व रेटिंग',
    tab_blogs: 'आध्यात्मिक लेख व पंचांग',
    tab_categories: 'पूजा श्रेणियाँ',
    tab_settings: 'वेबसाइट सेटिंग्स व पासवर्ड',
    logout: 'लॉगआउट',
    status_pending: 'Pending (लंबित)',
    status_sankalp_done: 'Sankalp Done (संकल्पित)',
    status_prasad_sent: 'Prasad Sent (प्रसाद प्रेषित)',
    status_completed: 'Completed (सम्पन्न)',
    btn_call_devotee: 'कॉल करें',
    btn_wa_devotee: 'व्हाट्सएप संदेश',
    order_sort: 'क्रम संख्या (Order)',
    save_changes: 'सुरक्षित करें',
    filter_by_date: 'तिथि अनुसार फ़िल्टर करें:',
    all_dates: 'सभी तिथियाँ',
    today: 'आज (Today)',
    search_devotees: 'यजमान का नाम, फोन, गोत्र खोजें...',
    add_new_pooja: '+ नई पूजा सेवा जोड़ें',
    add_new_pandit: '+ नया पुरोहित जोड़ें',
    add_new_blog: '+ नया लेख जोड़ें',
    add_new_cat: '+ नई श्रेणी जोड़ें',
    upload_photo: 'फोटो चुनें / अपलोड करें (< 2MB)',
    har_har_mahadev: 'हर हर महादेव! ॐ नमः शिवाय'
  },
  en: {
    site_title: 'Shree Omkareshwar Jyotirlinga',
    site_tagline: 'Pandit Shyam Geete • Vedic Pooja & Astro Seva',
    nav_home: 'Home',
    nav_pooja: 'Pooja Services',
    nav_pandits: 'Vidwan Pandits',
    nav_blogs: 'Spiritual Articles',
    nav_contact: 'Contact Us',
    nav_admin: 'Admin Portal',
    lang_toggle: 'हिंदी',
    hero_badge: 'Sacred Jyotirlinga Pilgrimage • 4th Jyotirlinga',
    hero_title_1: 'Shree Omkareshwar Jyotirlinga',
    hero_title_2: 'Authentic Vedic Pooja & Anushthan',
    hero_desc: 'Perform authentic Rudrabhishek, Kalsarp Dosh Nivaran, Navgraha Shanti, and Mahamrityunjay Jaap at the sacred Narmada banks under the learned guidance of Pandit Shyam Geete.',
    cta_book_pooja: 'Explore Poojas',
    cta_whatsapp_shastri: 'Contact Shastri Ji',
    aarti_timings_badge: SITE_CONFIG.aarti_timings_en,
    cat_all: 'All Services',
    starting_from: 'Dakshina starts from',
    select_variation: 'Select Package / Book',
    whatsapp_enquiry: 'WhatsApp Enquiry',
    custom_anushthan_title: 'Looking for a Custom Anushthan or Astro Remedy?',
    custom_anushthan_desc: 'If you require a specialized Anushthan according to your Kundali or customized Navgraha Shanti, consult directly with Pandit Shyam Geete.',
    custom_anushthan_btn: 'Consult Shastri Ji Direct',
    daily_blogs_title: 'Daily Panchang & Spiritual Articles',
    daily_blogs_sub: 'Darshan updates, festival dates, and sacred rituals from Omkareshwar Jyotirlinga',
    read_more: 'Read Full Article',
    close: 'Close',
    
    // Pandits Section
    pandits_title: 'Revered Tirth Purohits & Acharyas',
    pandits_sub: 'Certified Vedic Scholars and Experienced Acharyas of Omkareshwar',
    experience_suffix: 'Years Exp.',
    reviews_count_suffix: 'Satisfied Devotees',
    verified_acharya: 'Verified Vedic Acharya',
    consult_pandit: 'WhatsApp Consultation',

    // Trust & Contact
    trust_section_title: 'Authenticity & Devotee Trust',
    trust_section_sub: 'Rooted in sacred traditions with pure Vedic mantras and live Sankalp',
    trust_badge_1_title: 'Strict Vedic Sankalp',
    trust_badge_1_desc: 'Custom recitation of your Gotra and family names',
    trust_badge_2_title: 'Verified Tirth Purohits',
    trust_badge_2_desc: 'Guided by Pandit Shyam Geete & learned local scholars',
    trust_badge_3_title: 'Holy Narmada Abhishek',
    trust_badge_3_desc: 'Conducted using sacred holy waters of River Narmada',
    trust_badge_4_title: 'Video & Photo Proof',
    trust_badge_4_desc: 'Live sankalp recording and video updates sent on WhatsApp',

    hotline_title: 'Pandit Shyam Geete - Direct Helpline',
    hotline_sub: 'Available 24x7 for Muhurat, Sankalp and Pilgrim Assistance',
    call_now: 'Call Now',
    chat_whatsapp: 'Chat on WhatsApp',
    temple_location: SITE_CONFIG.temple_address_en,
    get_directions: 'View on Google Maps',
    quick_inquiry_title: 'Quick Pooja Booking & Sankalp Form',
    form_full_name: 'Devotee Full Name *',
    form_phone: 'Contact Phone Number *',
    form_whatsapp: 'WhatsApp Number *',
    form_gotra: 'Gotra (Kashyap if unknown)',
    form_nakshatra: 'Birth Nakshatra / Rashi',
    form_date: 'Preferred Pooja Date *',
    form_wishes: 'Special Prayer / Intention',
    form_submit: 'Confirm Booking Request',
    submitting: 'Please wait...',
    variation_modal_title: 'Pooja Packages & Dakshina Details',
    select_package_btn: 'Select Package & Book',

    // Devotee CRM / Admin
    admin_portal_title: 'Pandit Shyam Geete - Management Portal',
    tab_crm: 'Devotee Bookings CRM',
    tab_poojas: 'Pooja Services & Packages',
    tab_pandits: 'Pandits & Ratings',
    tab_blogs: 'Spiritual Articles',
    tab_categories: 'Pooja Categories',
    tab_settings: 'Settings & Password',
    logout: 'Logout',
    status_pending: 'Pending',
    status_sankalp_done: 'Sankalp Done',
    status_prasad_sent: 'Prasad Sent',
    status_completed: 'Completed',
    btn_call_devotee: 'Call Devotee',
    btn_wa_devotee: 'WhatsApp Message',
    order_sort: 'Display Order',
    save_changes: 'Save Changes',
    filter_by_date: 'Filter by Date:',
    all_dates: 'All Dates',
    today: 'Today',
    search_devotees: 'Search by name, phone, gotra...',
    add_new_pooja: '+ Add New Pooja',
    add_new_pandit: '+ Add New Pandit',
    add_new_blog: '+ Add New Article',
    add_new_cat: '+ Add Category',
    upload_photo: 'Choose & Upload Image (< 2MB)',
    har_har_mahadev: 'Har Har Mahadev! Om Namah Shivaya'
  }
};

// ---------------------------------------------------------------------------
// Main Vue 3 Application Setup
// ---------------------------------------------------------------------------
const app = createApp({
  setup() {
    // Current Language: Default Hindi
    const currentLang = ref(localStorage.getItem('omkar_lang') || 'hi');
    const t = computed(() => i18n[currentLang.value] || i18n.hi);

    const toggleLanguage = () => {
      currentLang.value = currentLang.value === 'hi' ? 'en' : 'hi';
      localStorage.setItem('omkar_lang', currentLang.value);
    };

    // Navigation View: 'home' or 'admin'
    const currentView = ref(window.location.hash === '#/admin' ? 'admin' : 'home');
    const isMobileNavOpen = ref(false);

    // Global Notification Toast
    const toast = reactive({
      show: false,
      type: 'success', // 'success' | 'error' | 'info'
      message: ''
    });

    let toastTimer = null;
    const notify = (type, message) => {
      toast.type = type;
      toast.message = message;
      toast.show = true;
      if (toastTimer) clearTimeout(toastTimer);
      toastTimer = setTimeout(() => {
        toast.show = false;
      }, 4000);
    };

    // Navigate to Section or Admin View with Smooth Scrolling
    const navigateTo = (target) => {
      isMobileNavOpen.value = false;
      if (target === 'admin') {
        currentView.value = 'admin';
        window.location.hash = '/admin';
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
      }
      
      currentView.value = 'home';
      if (window.location.hash) {
        history.pushState('', document.title, window.location.pathname + window.location.search);
      }

      if (target === 'home') {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } else {
        setTimeout(() => {
          const el = document.getElementById(target + '-section');
          if (el) {
            const offset = 80;
            const bodyRect = document.body.getBoundingClientRect().top;
            const elementRect = el.getBoundingClientRect().top;
            const elementPosition = elementRect - bodyRect;
            const offsetPosition = elementPosition - offset;
            window.scrollTo({
              top: offsetPosition,
              behavior: 'smooth'
            });
          }
        }, 60);
      }
    };

    // Listen to hash change
    window.addEventListener('hashchange', () => {
      if (window.location.hash === '#/admin') {
        currentView.value = 'admin';
      } else {
        currentView.value = 'home';
      }
    });

    // -----------------------------------------------------------------------
    // Core Reactive State
    // -----------------------------------------------------------------------
    const categories = ref([]);
    const poojas = ref([]);
    const pandits = ref([]);
    const blogs = ref([]);
    const bookings = ref([]);
    const siteSettings = reactive({ ...SITE_CONFIG });

    const selectedCategorySlug = ref('all');
    const selectedPoojaForVariations = ref(null);
    const showVariationModal = ref(false);

    // Blog Modal
    const selectedBlog = ref(null);
    const showBlogModal = ref(false);

    // Booking Form State
    const bookingForm = reactive({
      pooja_id: '',
      variation_id: '',
      devotee_name: '',
      phone: '',
      whatsapp_number: '',
      gotra: '',
      nakshatra: '',
      rashi: '',
      pooja_date: new Date().toISOString().split('T')[0],
      special_wishes: ''
    });
    const isSubmittingBooking = ref(false);

    // Admin Authentication State
    const authToken = ref(localStorage.getItem('omkar_admin_token') || '');
    const adminUser = ref(JSON.parse(localStorage.getItem('omkar_admin_user') || 'null'));
    const loginForm = reactive({
      email: 'admin@omkareshwar.local',
      password: ''
    });
    const isLoggingIn = ref(false);
    const activeAdminTab = ref('crm');

    // CRM Filters
    const crmDateFilter = ref('all');
    const crmSearchQuery = ref('');

    // Admin Modals & Editing State
    const showPoojaModal = ref(false);
    const editingPooja = reactive({
      id: null,
      category_id: 1,
      name_hi: '',
      name_en: '',
      description_hi: '',
      description_en: '',
      image_url: '',
      display_order: 0,
      is_active: 1,
      variations: []
    });

    const showPanditModal = ref(false);
    const editingPandit = reactive({
      id: null,
      name_hi: '',
      name_en: '',
      title_hi: 'तीर्थ पुरोहित',
      title_en: 'Tirth Purohit',
      specialization_hi: 'रुद्राभिषेक, महामृत्युंजय जाप',
      specialization_en: 'Rudrabhishek, Mahamrityunjay',
      experience_years: 10,
      rating: 5.0,
      reviews_count: 120,
      image_url: '',
      phone: '9977557063',
      whatsapp_number: '919977557063',
      bio_hi: '',
      bio_en: '',
      display_order: 0,
      is_active: 1
    });

    const showBlogEditModal = ref(false);
    const editingBlog = reactive({
      id: null,
      title_hi: '',
      title_en: '',
      content_hi: '',
      content_en: '',
      image_url: '',
      is_published: 1
    });

    const showCategoryModal = ref(false);
    const editingCategory = reactive({
      id: null,
      name_hi: '',
      name_en: '',
      slug: '',
      display_order: 0,
      is_active: 1
    });

    const passwordChangeForm = reactive({
      old_password: '',
      new_password: '',
      confirm_password: ''
    });

    const isUploadingImage = ref(false);

    // -----------------------------------------------------------------------
    // Data Fetching Methods
    // -----------------------------------------------------------------------
    const fetchCategories = async () => {
      try {
        const res = await fetch('api/categories.php');
        const data = await res.json();
        if (data.success) {
          categories.value = data.data || [];
        }
      } catch (err) {
        console.error('Error fetching categories:', err);
      }
    };

    const fetchPoojas = async () => {
      try {
        const res = await fetch('api/poojas.php?all=1');
        const data = await res.json();
        if (data.success) {
          poojas.value = data.data || [];
        }
      } catch (err) {
        console.error('Error fetching poojas:', err);
      }
    };

    const fetchPandits = async () => {
      try {
        const res = await fetch('api/pandits.php?admin=1');
        const data = await res.json();
        if (data.success) {
          pandits.value = data.data || [];
        }
      } catch (err) {
        console.error('Error fetching pandits:', err);
      }
    };

    const fetchBlogs = async () => {
      try {
        const res = await fetch('api/blogs.php?all=1');
        const data = await res.json();
        if (data.success) {
          blogs.value = data.data || [];
        }
      } catch (err) {
        console.error('Error fetching blogs:', err);
      }
    };

    const fetchBookings = async () => {
      if (!authToken.value) return;
      try {
        const res = await fetch(`api/bookings.php?token=${authToken.value}`, {
          headers: {
            'Authorization': 'Bearer ' + authToken.value
          }
        });
        const data = await res.json();
        if (data.success && Array.isArray(data.data)) {
          bookings.value = data.data;
        } else {
          bookings.value = [];
        }
      } catch (err) {
        console.error('Error fetching bookings:', err);
        bookings.value = [];
      }
    };

    // Filtered Poojas for Homepage
    const filteredPoojas = computed(() => {
      const active = (poojas.value || []).filter(p => p && p.is_active == 1);
      if (selectedCategorySlug.value === 'all') return active;
      return active.filter(p => p.category_slug === selectedCategorySlug.value);
    });

    // Active Pandits for Homepage
    const activePandits = computed(() => {
      return (pandits.value || []).filter(p => p && p.is_active == 1);
    });

    // Published Blogs for Homepage
    const publishedBlogs = computed(() => {
      return (blogs.value || []).filter(b => b && b.is_published == 1);
    });

    // Filtered Bookings for Admin CRM
    const filteredBookings = computed(() => {
      let list = Array.isArray(bookings.value) ? [...bookings.value] : [];
      const todayStr = new Date().toISOString().split('T')[0];

      if (crmDateFilter.value === 'today') {
        list = list.filter(b => (b.preferred_date && b.preferred_date === todayStr) || (b.pooja_date && b.pooja_date === todayStr) || (b.created_at && b.created_at.startsWith(todayStr)));
      } else if (crmDateFilter.value !== 'all' && crmDateFilter.value) {
        list = list.filter(b => b.preferred_date === crmDateFilter.value || b.pooja_date === crmDateFilter.value);
      }

      if (crmSearchQuery.value.trim()) {
        const q = crmSearchQuery.value.toLowerCase().trim();
        list = list.filter(b => 
          (b.full_name && b.full_name.toLowerCase().includes(q)) ||
          (b.devotee_name && b.devotee_name.toLowerCase().includes(q)) ||
          (b.phone && b.phone.includes(q)) ||
          (b.whatsapp_number && b.whatsapp_number.includes(q)) ||
          (b.gotra && b.gotra.toLowerCase().includes(q)) ||
          (b.pooja_name_hi && b.pooja_name_hi.toLowerCase().includes(q)) ||
          (b.pooja_name_en && b.pooja_name_en.toLowerCase().includes(q)) ||
          (b.pooja_name && b.pooja_name.toLowerCase().includes(q))
        );
      }
      return list;
    });

    // -----------------------------------------------------------------------
    // Image Upload Handler (< 2MB Strict Enforcement)
    // -----------------------------------------------------------------------
    const uploadImageFile = async (event, folder, targetCallback) => {
      const file = event.target.files?.[0];
      if (!file) return;

      // Check strictly <= 2MB
      if (file.size > 2 * 1024 * 1024) {
        notify('error', 'फ़ाइल 2MB से अधिक है। कृपया 2MB से छोटी छवि चुनें। (Max 2MB)');
        event.target.value = '';
        return;
      }

      const formData = new FormData();
      formData.append('file', file);
      formData.append('folder', folder);
      if (authToken.value) {
        formData.append('token', authToken.value);
      }

      isUploadingImage.value = true;
      try {
        const res = await fetch('api/upload.php', {
          method: 'POST',
          headers: {
            'Authorization': 'Bearer ' + (authToken.value || '')
          },
          body: formData
        });
        const data = await res.json();
        if (data.success && data.data?.relative_url) {
          targetCallback(data.data.relative_url);
          notify('success', 'छवि सफलतापूर्वक अपलोड हुई! (< 2MB)');
        } else {
          notify('error', data.message || 'छवि अपलोड असफल रही।');
        }
      } catch (err) {
        notify('error', 'अपलोड त्रुटि: ' + err.message);
      } finally {
        isUploadingImage.value = false;
        event.target.value = '';
      }
    };

    // Pandit Photo Upload
    const uploadPanditPhoto = (e) => {
      uploadImageFile(e, 'pandits', (url) => {
        editingPandit.image_url = url;
      });
    };

    // Pooja Photo Upload
    const uploadPoojaPhoto = (e) => {
      uploadImageFile(e, 'poojas', (url) => {
        editingPooja.image_url = url;
      });
    };

    // Blog Photo Upload
    const uploadBlogPhoto = (e) => {
      uploadImageFile(e, 'blogs', (url) => {
        editingBlog.image_url = url;
      });
    };

    // -----------------------------------------------------------------------
    // Booking Form & Modal Actions
    // -----------------------------------------------------------------------
    const openVariationModal = (pooja) => {
      selectedPoojaForVariations.value = pooja;
      bookingForm.pooja_id = pooja.id;
      if (pooja.variations && pooja.variations.length > 0) {
        bookingForm.variation_id = pooja.variations[0].id;
      } else {
        bookingForm.variation_id = '';
      }
      showVariationModal.value = true;
    };

    const selectPackageAndScroll = (variation) => {
      bookingForm.variation_id = variation.id;
      showVariationModal.value = false;
      navigateTo('booking');
    };

    const openBlogDetails = (blog) => {
      selectedBlog.value = blog;
      showBlogModal.value = true;
    };

    const submitBooking = async () => {
      if (!bookingForm.devotee_name.trim() || !bookingForm.phone.trim() || !bookingForm.pooja_id) {
        notify('error', 'कृपया नाम, फोन नंबर एवं पूजा का चयन करें।');
        return;
      }

      isSubmittingBooking.value = true;
      try {
        const res = await fetch('api/bookings.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(bookingForm)
        });
        const data = await res.json();
        if (data.success) {
          notify('success', 'आपकी पूजा बुकिंग एवं संकल्प अनुरोध सफलतापूर्वक दर्ज हो गया है! शास्त्री जी शीघ्र संपर्क करेंगे।');
          
          // Open WhatsApp with booking confirmation
          if (data.data?.whatsapp_direct_url) {
            window.open(data.data.whatsapp_direct_url, '_blank');
          }
          
          // Reset form
          bookingForm.devotee_name = '';
          bookingForm.phone = '';
          bookingForm.whatsapp_number = '';
          bookingForm.gotra = '';
          bookingForm.special_wishes = '';
          if (authToken.value) fetchBookings();
        } else {
          notify('error', data.message || 'बुकिंग दर्ज करने में त्रुटि आई।');
        }
      } catch (err) {
        notify('error', 'नेटवर्क त्रुटि: ' + err.message);
      } finally {
        isSubmittingBooking.value = false;
      }
    };

    // -----------------------------------------------------------------------
    // Admin Authentication & Session Management
    // -----------------------------------------------------------------------
    const handleLogin = async () => {
      if (!loginForm.email || !loginForm.password) {
        notify('error', 'कृपया ईमेल एवं पासवर्ड दोनों दर्ज करें।');
        return;
      }

      isLoggingIn.value = true;
      try {
        const res = await fetch('api/auth.php?action=login', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(loginForm)
        });
        const data = await res.json();
        if (data.success && data.data?.token) {
          authToken.value = data.data.token;
          adminUser.value = data.data.user;
          localStorage.setItem('omkar_admin_token', data.data.token);
          localStorage.setItem('omkar_admin_user', JSON.stringify(data.data.user));
          notify('success', 'प्रबंधन पोर्टल में स्वागत है, ' + (data.data.user.name || 'Admin'));
          fetchBookings();
        } else {
          notify('error', data.message || 'लॉगिन असफल रहा। कृपया सही क्रेडेंशियल दर्ज करें।');
        }
      } catch (err) {
        notify('error', 'लॉगिन त्रुटि: ' + err.message);
      } finally {
        isLoggingIn.value = false;
      }
    };

    const handleLogout = async () => {
      try {
        await fetch('api/auth.php?action=logout', { method: 'POST' });
      } catch (e) {}
      authToken.value = '';
      adminUser.value = null;
      localStorage.removeItem('omkar_admin_token');
      localStorage.removeItem('omkar_admin_user');
      notify('info', 'सफलतापूर्वक लॉगआउट हो गया।');
    };

    const updateBookingStatus = async (bookingId, newStatus) => {
      try {
        const res = await fetch(`api/bookings.php?id=${bookingId}&token=${authToken.value}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken.value
          },
          body: JSON.stringify({ id: bookingId, status: newStatus })
        });
        const data = await res.json();
        if (data.success) {
          notify('success', 'स्थिति अपडेट हो गई: ' + newStatus);
          const found = bookings.value.find(b => b.id == bookingId);
          if (found) found.status = newStatus;
        } else {
          notify('error', data.message || 'स्थिति अपडेट नहीं हो सकी।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    // -----------------------------------------------------------------------
    // Pandit Management CRUD
    // -----------------------------------------------------------------------
    const openPanditModal = (pandit = null) => {
      if (pandit) {
        Object.assign(editingPandit, {
          id: pandit.id,
          name_hi: pandit.name_hi,
          name_en: pandit.name_en || pandit.name_hi,
          title_hi: pandit.title_hi || 'तीर्थ पुरोहित',
          title_en: pandit.title_en || 'Tirth Purohit',
          specialization_hi: pandit.specialization_hi || '',
          specialization_en: pandit.specialization_en || '',
          experience_years: Number(pandit.experience_years) || 10,
          rating: Number(pandit.rating) || 5.0,
          reviews_count: Number(pandit.reviews_count) || 100,
          image_url: pandit.image_url || '',
          phone: pandit.phone || '9977557063',
          whatsapp_number: pandit.whatsapp_number || '919977557063',
          bio_hi: pandit.bio_hi || '',
          bio_en: pandit.bio_en || '',
          display_order: Number(pandit.display_order) || 0,
          is_active: Number(pandit.is_active) ?? 1
        });
      } else {
        Object.assign(editingPandit, {
          id: null,
          name_hi: '',
          name_en: '',
          title_hi: 'तीर्थ पुरोहित',
          title_en: 'Tirth Purohit',
          specialization_hi: 'रुद्राभिषेक, महामृत्युंजय जाप',
          specialization_en: 'Rudrabhishek, Mahamrityunjay',
          experience_years: 10,
          rating: 5.0,
          reviews_count: 100,
          image_url: 'uploads/pandits/pandits_1789879471_309e213c.jpg',
          phone: '9977557063',
          whatsapp_number: '919977557063',
          bio_hi: '',
          bio_en: '',
          display_order: pandits.value.length,
          is_active: 1
        });
      }
      showPanditModal.value = true;
    };

    const savePanditProfile = async () => {
      if (!editingPandit.name_hi.trim()) {
        notify('error', 'पंडित का नाम (हिंदी में) अनिवार्य है।');
        return;
      }

      const method = editingPandit.id ? 'PUT' : 'POST';
      const url = `api/pandits.php${editingPandit.id ? '?id=' + editingPandit.id : ''}&token=${authToken.value}`;

      try {
        const res = await fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken.value
          },
          body: JSON.stringify(editingPandit)
        });
        const data = await res.json();
        if (data.success) {
          notify('success', editingPandit.id ? 'पुरोहित प्रोफ़ाइल सफलतापूर्वक अपडेट हुई!' : 'नया पुरोहित सफलतापूर्वक जोड़ा गया!');
          showPanditModal.value = false;
          fetchPandits();
        } else {
          notify('error', data.message || 'सुरक्षित करने में त्रुटि आई।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    const deletePanditProfile = async (id) => {
      if (!confirm('क्या आप सचमुच इस पुरोहित प्रोफ़ाइल को हटाना चाहते हैं?')) return;
      try {
        const res = await fetch(`api/pandits.php?id=${id}&token=${authToken.value}`, {
          method: 'DELETE',
          headers: { 'Authorization': 'Bearer ' + authToken.value }
        });
        const data = await res.json();
        if (data.success) {
          notify('success', 'पुरोहित हटा दिया गया।');
          fetchPandits();
        } else {
          notify('error', data.message || 'हटाया नहीं जा सका।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    // -----------------------------------------------------------------------
    // Pooja Management CRUD & Dynamic Variations
    // -----------------------------------------------------------------------
    const openPoojaModal = (pooja = null) => {
      if (pooja) {
        Object.assign(editingPooja, {
          id: pooja.id,
          category_id: pooja.category_id || (categories.value[0]?.id || 1),
          name_hi: pooja.name_hi,
          name_en: pooja.name_en || pooja.name_hi,
          description_hi: pooja.description_hi || '',
          description_en: pooja.description_en || '',
          image_url: pooja.image_url || '',
          display_order: Number(pooja.display_order) || 0,
          is_active: Number(pooja.is_active) ?? 1,
          variations: (pooja.variations || []).map(v => ({ ...v }))
        });
      } else {
        Object.assign(editingPooja, {
          id: null,
          category_id: categories.value[0]?.id || 1,
          name_hi: '',
          name_en: '',
          description_hi: '',
          description_en: '',
          image_url: 'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80',
          display_order: poojas.value.length,
          is_active: 1,
          variations: [
            { id: null, title_hi: 'सामान्य संकल्प', title_en: 'Normal Sankalp', price: 1100, description_hi: '1 शास्त्री जी द्वारा पूजन', description_en: '1 Shastri', display_order: 1 },
            { id: null, title_hi: 'विशेष अनुष्ठान', title_en: 'Vishesh Anushthan', price: 2100, description_hi: '2 शास्त्री जी द्वारा सविधि रुद्राभिषेक', description_en: '2 Shastris', display_order: 2 }
          ]
        });
      }
      showPoojaModal.value = true;
    };

    const addVariationRow = () => {
      editingPooja.variations.push({
        id: null,
        title_hi: 'नया पैकेज',
        title_en: 'New Package',
        price: 1500,
        description_hi: 'शास्त्रोक्त विधि से पूजन',
        description_en: 'Vedic Pooja',
        display_order: editingPooja.variations.length + 1
      });
    };

    const removeVariationRow = (index) => {
      editingPooja.variations.splice(index, 1);
    };

    const savePoojaProfile = async () => {
      if (!editingPooja.name_hi.trim() || !editingPooja.name_en.trim()) {
        notify('error', 'पूजा का नाम हिंदी एवं अंग्रेजी दोनों में अनिवार्य है।');
        return;
      }

      const method = editingPooja.id ? 'PUT' : 'POST';
      const url = `api/poojas.php${editingPooja.id ? '?id=' + editingPooja.id : ''}&token=${authToken.value}`;

      try {
        const res = await fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken.value
          },
          body: JSON.stringify(editingPooja)
        });
        const data = await res.json();
        if (data.success) {
          notify('success', editingPooja.id ? 'पूजा सेवा व पैकेज सुरक्षित हुए!' : 'नई पूजा सेवा जोड़ी गई!');
          showPoojaModal.value = false;
          fetchPoojas();
        } else {
          notify('error', data.message || 'सुरक्षित करने में त्रुटि आई।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    const deletePoojaProfile = async (id) => {
      if (!confirm('क्या आप सचमुच इस पूजा सेवा को हटाना चाहते हैं?')) return;
      try {
        const res = await fetch(`api/poojas.php?id=${id}&token=${authToken.value}`, {
          method: 'DELETE',
          headers: { 'Authorization': 'Bearer ' + authToken.value }
        });
        const data = await res.json();
        if (data.success) {
          notify('success', 'पूजा सेवा हटा दी गई।');
          fetchPoojas();
        } else {
          notify('error', data.message || 'हटाया नहीं जा सका।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    // -----------------------------------------------------------------------
    // Blog Management CRUD
    // -----------------------------------------------------------------------
    const openBlogEditModal = (blog = null) => {
      if (blog) {
        Object.assign(editingBlog, {
          id: blog.id,
          title_hi: blog.title_hi,
          title_en: blog.title_en || blog.title_hi,
          content_hi: blog.content_hi || '',
          content_en: blog.content_en || '',
          image_url: blog.image_url || '',
          is_published: Number(blog.is_published) ?? 1
        });
      } else {
        Object.assign(editingBlog, {
          id: null,
          title_hi: '',
          title_en: '',
          content_hi: '',
          content_en: '',
          image_url: 'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80',
          is_published: 1
        });
      }
      showBlogEditModal.value = true;
    };

    const saveBlogArticle = async () => {
      if (!editingBlog.title_hi.trim() || !editingBlog.content_hi.trim()) {
        notify('error', 'ब्लॉग शीर्षक एवं सामग्री (हिंदी) अनिवार्य है।');
        return;
      }

      const method = editingBlog.id ? 'PUT' : 'POST';
      const url = `api/blogs.php${editingBlog.id ? '?id=' + editingBlog.id : ''}&token=${authToken.value}`;

      try {
        const res = await fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken.value
          },
          body: JSON.stringify(editingBlog)
        });
        const data = await res.json();
        if (data.success) {
          notify('success', editingBlog.id ? 'लेख सफलतापूर्वक अपडेट हुआ!' : 'नया लेख प्रकाशित हुआ!');
          showBlogEditModal.value = false;
          fetchBlogs();
        } else {
          notify('error', data.message || 'सुरक्षित करने में त्रुटि आई।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    const deleteBlogArticle = async (id) => {
      if (!confirm('क्या आप सचमुच इस लेख को हटाना चाहते हैं?')) return;
      try {
        const res = await fetch(`api/blogs.php?id=${id}&token=${authToken.value}`, {
          method: 'DELETE',
          headers: { 'Authorization': 'Bearer ' + authToken.value }
        });
        const data = await res.json();
        if (data.success) {
          notify('success', 'लेख हटा दिया गया।');
          fetchBlogs();
        } else {
          notify('error', data.message || 'हटाया नहीं जा सका।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    // -----------------------------------------------------------------------
    // Category Management CRUD
    // -----------------------------------------------------------------------
    const openCategoryModal = (cat = null) => {
      if (cat) {
        Object.assign(editingCategory, {
          id: cat.id,
          name_hi: cat.name_hi,
          name_en: cat.name_en || cat.name_hi,
          slug: cat.slug || '',
          display_order: Number(cat.display_order) || 0,
          is_active: Number(cat.is_active) ?? 1
        });
      } else {
        Object.assign(editingCategory, {
          id: null,
          name_hi: '',
          name_en: '',
          slug: '',
          display_order: categories.value.length,
          is_active: 1
        });
      }
      showCategoryModal.value = true;
    };

    const saveCategory = async () => {
      if (!editingCategory.name_hi.trim() || !editingCategory.name_en.trim()) {
        notify('error', 'श्रेणी का नाम हिंदी एवं अंग्रेजी दोनों में अनिवार्य है।');
        return;
      }
      if (!editingCategory.slug.trim()) {
        editingCategory.slug = editingCategory.name_en.toLowerCase().replace(/[^a-z0-9]+/g, '-');
      }

      const method = editingCategory.id ? 'PUT' : 'POST';
      const url = `api/categories.php${editingCategory.id ? '?id=' + editingCategory.id : ''}&token=${authToken.value}`;

      try {
        const res = await fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken.value
          },
          body: JSON.stringify(editingCategory)
        });
        const data = await res.json();
        if (data.success) {
          notify('success', 'श्रेणी सफलतापूर्वक सुरक्षित हुई!');
          showCategoryModal.value = false;
          fetchCategories();
        } else {
          notify('error', data.message || 'सुरक्षित करने में त्रुटि आई।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    // -----------------------------------------------------------------------
    // Password Change & Security
    // -----------------------------------------------------------------------
    const changeAdminPassword = async () => {
      if (!passwordChangeForm.old_password || !passwordChangeForm.new_password) {
        notify('error', 'कृपया पुराना व नया पासवर्ड दर्ज करें।');
        return;
      }
      if (passwordChangeForm.new_password !== passwordChangeForm.confirm_password) {
        notify('error', 'नया पासवर्ड और पुष्टि पासवर्ड समान नहीं हैं।');
        return;
      }
      if (passwordChangeForm.new_password.length < 8) {
        notify('error', 'नया पासवर्ड कम से कम 8 अक्षरों का होना चाहिए।');
        return;
      }

      try {
        const res = await fetch('api/auth.php?action=change_password', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken.value
          },
          body: JSON.stringify({
            old_password: passwordChangeForm.old_password,
            new_password: passwordChangeForm.new_password
          })
        });
        const data = await res.json();
        if (data.success) {
          notify('success', 'पासवर्ड सफलतापूर्वक बदल दिया गया! सुरक्षित लॉगआउट करें।');
          passwordChangeForm.old_password = '';
          passwordChangeForm.new_password = '';
          passwordChangeForm.confirm_password = '';
        } else {
          notify('error', data.message || 'पासवर्ड बदलने में त्रुटि।');
        }
      } catch (err) {
        notify('error', 'त्रुटि: ' + err.message);
      }
    };

    // -----------------------------------------------------------------------
    // Lifecycle Mounting
    // -----------------------------------------------------------------------
    onMounted(() => {
      fetchCategories();
      fetchPoojas();
      fetchPandits();
      fetchBlogs();
      if (authToken.value) {
        fetchBookings();
      }
    });

    return {
      SITE_CONFIG,
      currentLang,
      t,
      toggleLanguage,
      currentView,
      isMobileNavOpen,
      navigateTo,
      toast,
      notify,

      // Public Entities
      categories,
      poojas,
      pandits,
      blogs,
      selectedCategorySlug,
      filteredPoojas,
      activePandits,
      publishedBlogs,

      // Modals
      selectedPoojaForVariations,
      showVariationModal,
      openVariationModal,
      selectPackageAndScroll,
      selectedBlog,
      showBlogModal,
      openBlogDetails,

      // Devotee Booking Form
      bookingForm,
      isSubmittingBooking,
      submitBooking,

      // Admin & CRM
      bookings,
      authToken,
      adminUser,
      loginForm,
      isLoggingIn,
      activeAdminTab,
      crmDateFilter,
      crmSearchQuery,
      filteredBookings,
      handleLogin,
      handleLogout,
      updateBookingStatus,

      // Admin Management CRUD & Modals
      showPoojaModal,
      editingPooja,
      openPoojaModal,
      addVariationRow,
      removeVariationRow,
      savePoojaProfile,
      deletePoojaProfile,

      showPanditModal,
      editingPandit,
      openPanditModal,
      savePanditProfile,
      deletePanditProfile,

      showBlogEditModal,
      editingBlog,
      openBlogEditModal,
      saveBlogArticle,
      deleteBlogArticle,

      showCategoryModal,
      editingCategory,
      openCategoryModal,
      saveCategory,

      passwordChangeForm,
      changeAdminPassword,

      // Uploads (< 2MB)
      isUploadingImage,
      uploadPanditPhoto,
      uploadPoojaPhoto,
      uploadBlogPhoto
    };
  },
  template: `
  <div class="min-h-screen flex flex-col selection:bg-amber-600 selection:text-white">
    
    <!-- Toast Notification -->
    <div v-if="toast.show" 
         class="fixed bottom-20 md:bottom-8 right-4 z-50 max-w-md px-5 py-4 rounded-xl shadow-2xl flex items-center gap-3 text-white transition-all transform animate-fadeIn font-medium text-sm"
         :class="toast.type === 'error' ? 'bg-red-600' : (toast.type === 'info' ? 'bg-blue-600' : 'bg-emerald-700')">
      <span class="text-xl">{{ toast.type === 'error' ? '⚠️' : (toast.type === 'info' ? 'ℹ️' : '✅') }}</span>
      <span class="flex-1">{{ toast.message }}</span>
      <button @click="toast.show = false" class="text-white/80 hover:text-white text-lg font-bold">×</button>
    </div>

    <!-- Top Announcement Bar -->
    <div class="sacred-gradient-bg text-white text-xs md:text-sm py-2 px-4 shadow-md flex items-center justify-between">
      <div class="max-w-7xl mx-auto w-full flex items-center justify-between">
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 rounded-full bg-amber-300 animate-ping"></span>
          <span class="font-medium tracking-wide">🕉️ {{ t.aarti_timings_badge }}</span>
        </div>
        <div class="flex items-center gap-4 text-xs">
          <a :href="'tel:' + SITE_CONFIG.primary_phone" class="hidden sm:inline-flex items-center gap-1 text-amber-200 hover:text-white">
            📞 {{ SITE_CONFIG.primary_phone }}
          </a>
          <button @click="toggleLanguage" class="bg-white/20 hover:bg-white/30 text-white font-semibold px-2.5 py-0.5 rounded text-xs transition border border-white/25">
            🌐 {{ t.lang_toggle }}
          </button>
        </div>
      </div>
    </div>

    <!-- Main Header & Glass Navigation Bar -->
    <header class="sticky top-0 z-40 glass-nav border-b border-amber-900/10 shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        
        <!-- Logo & Branding -->
        <a href="javascript:void(0)" @click="navigateTo('home')" class="flex items-center gap-3 group">
          <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-600 to-red-800 flex items-center justify-center text-white text-2xl font-bold shadow-sacred transform group-hover:scale-105 transition">
            ॐ
          </div>
          <div>
            <h1 class="text-lg md:text-xl font-bold font-divine text-sacred-900 leading-tight">
              {{ t.site_title }}
            </h1>
            <p class="text-xs font-medium text-sacred-600">
              {{ t.site_tagline }}
            </p>
          </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden lg:flex items-center gap-1 font-medium text-sacred-800 text-sm">
          <button @click="navigateTo('home')" 
                  class="px-3.5 py-2 rounded-lg transition"
                  :class="currentView === 'home' ? 'text-sacred-600 font-semibold bg-amber-50/80' : 'hover:text-sacred-600 hover:bg-amber-50/50'">
            {{ t.nav_home }}
          </button>
          <button @click="navigateTo('poojas')" class="px-3.5 py-2 rounded-lg hover:text-sacred-600 hover:bg-amber-50/50 transition">
            {{ t.nav_pooja }}
          </button>
          <button @click="navigateTo('pandits')" class="px-3.5 py-2 rounded-lg hover:text-sacred-600 hover:bg-amber-50/50 transition">
            {{ t.nav_pandits }}
          </button>
          <button @click="navigateTo('blogs')" class="px-3.5 py-2 rounded-lg hover:text-sacred-600 hover:bg-amber-50/50 transition">
            {{ t.nav_blogs }}
          </button>
          <button @click="navigateTo('contact')" class="px-3.5 py-2 rounded-lg hover:text-sacred-600 hover:bg-amber-50/50 transition">
            {{ t.nav_contact }}
          </button>
          
          <div class="h-5 w-px bg-amber-300 mx-2"></div>

          <!-- Admin Portal Link -->
          <button @click="navigateTo('admin')" 
                  class="px-3 py-1.5 rounded-lg border text-xs font-semibold flex items-center gap-1.5 transition"
                  :class="currentView === 'admin' ? 'bg-sacred-800 text-white border-sacred-800 shadow-sm' : 'border-amber-700/30 text-sacred-800 hover:bg-amber-100/50'">
            🔒 {{ t.nav_admin }}
          </button>
        </nav>

        <!-- Right Quick Action / WhatsApp CTA -->
        <div class="flex items-center gap-2">
          <a :href="'https://wa.me/' + SITE_CONFIG.whatsapp_number + '?text=' + encodeURIComponent('जय श्री ओंकारेश्वर! मुझे पूजा संकल्प के बारे में मार्गदर्शन चाहिए।')" 
             target="_blank"
             class="hidden sm:inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition text-xs md:text-sm">
            <span>💬</span>
            <span>{{ t.chat_whatsapp }}</span>
          </a>

          <!-- Mobile Hamburger Toggle -->
          <button @click="isMobileNavOpen = !isMobileNavOpen" 
                  class="lg:hidden p-2.5 rounded-lg bg-amber-100 text-sacred-800 hover:bg-amber-200 transition focus:outline-none"
                  aria-label="Menu">
            <span class="text-xl">{{ isMobileNavOpen ? '✕' : '☰' }}</span>
          </button>
        </div>
      </div>

      <!-- Mobile Dropdown Navigation -->
      <div v-if="isMobileNavOpen" class="lg:hidden bg-white/95 border-b border-amber-200 px-4 py-4 space-y-2 shadow-xl animate-fadeIn">
        <button @click="navigateTo('home')" class="block w-full text-left px-3 py-2.5 rounded-lg font-medium text-sacred-900 hover:bg-amber-50">
          🏠 {{ t.nav_home }}
        </button>
        <button @click="navigateTo('poojas')" class="block w-full text-left px-3 py-2.5 rounded-lg font-medium text-sacred-900 hover:bg-amber-50">
          🔱 {{ t.nav_pooja }}
        </button>
        <button @click="navigateTo('pandits')" class="block w-full text-left px-3 py-2.5 rounded-lg font-medium text-sacred-900 hover:bg-amber-50">
          🙏 {{ t.nav_pandits }}
        </button>
        <button @click="navigateTo('blogs')" class="block w-full text-left px-3 py-2.5 rounded-lg font-medium text-sacred-900 hover:bg-amber-50">
          📖 {{ t.nav_blogs }}
        </button>
        <button @click="navigateTo('contact')" class="block w-full text-left px-3 py-2.5 rounded-lg font-medium text-sacred-900 hover:bg-amber-50">
          📞 {{ t.nav_contact }}
        </button>
        <button @click="navigateTo('admin')" class="block w-full text-left px-3 py-2.5 rounded-lg font-semibold text-sacred-800 bg-amber-100/70 hover:bg-amber-200">
          🔒 {{ t.nav_admin }}
        </button>
        <div class="pt-2 border-t border-amber-200 flex items-center justify-between">
          <span class="text-xs text-stone-500 font-medium">भाषा / Language:</span>
          <button @click="toggleLanguage" class="bg-sacred-700 text-white text-xs px-3 py-1 rounded font-medium">
            🌐 {{ t.lang_toggle }}
          </button>
        </div>
      </div>
    </header>

    <!-- ================================================================= -->
    <!-- VIEW 1: PUBLIC HOMEPAGE (Mobile First, Sacred & Comprehensive)    -->
    <!-- ================================================================= -->
    <main v-if="currentView === 'home'" class="flex-grow">
      
      <!-- HERO SECTION -->
      <section class="relative sacred-texture-bg pt-10 pb-16 md:pt-16 md:pb-24 overflow-hidden border-b border-amber-900/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Hero Copy -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
              <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 border border-amber-300 text-sacred-800 text-xs md:text-sm font-semibold shadow-sm">
                <span>✨</span>
                <span>{{ t.hero_badge }}</span>
              </div>
              <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold font-divine text-sacred-900 leading-tight">
                {{ t.hero_title_1 }}<br/>
                <span class="bg-gradient-to-r from-sacred-600 via-amber-600 to-sacred-800 bg-clip-text text-transparent">
                  {{ t.hero_title_2 }}
                </span>
              </h1>
              <p class="text-base sm:text-lg text-stone-700 leading-relaxed font-normal max-w-2xl mx-auto lg:mx-0">
                {{ t.hero_desc }}
              </p>

              <!-- CTAs -->
              <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                <button @click="navigateTo('poojas')" 
                        class="w-full sm:w-auto px-7 py-3.5 rounded-xl saffron-gradient-bg text-white font-bold text-base shadow-sacred hover:shadow-sacred-lg transform hover:-translate-y-0.5 transition flex items-center justify-center gap-2">
                  <span>🔱</span>
                  <span>{{ t.cta_book_pooja }}</span>
                </button>
                <a :href="'https://wa.me/' + SITE_CONFIG.whatsapp_number + '?text=' + encodeURIComponent('प्रणाम शास्त्री जी, मुझे ओंकारेश्वर में पूजा संकल्प एवं मुहूर्त के बारे में परामर्श चाहिए।')" 
                   target="_blank"
                   class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-white border-2 border-sacred-600 text-sacred-700 font-bold text-base hover:bg-amber-50 shadow-sm transition flex items-center justify-center gap-2">
                  <span>💬</span>
                  <span>{{ t.cta_whatsapp_shastri }}</span>
                </a>
              </div>

              <!-- Quick Highlights -->
              <div class="grid grid-cols-3 gap-3 pt-6 border-t border-amber-900/10 text-center">
                <div class="p-3 bg-white/70 rounded-xl shadow-xs border border-amber-200/60">
                  <div class="text-xl md:text-2xl font-bold font-divine text-sacred-800">100%</div>
                  <div class="text-xs text-stone-600 font-medium">शास्त्रोक्त विधि</div>
                </div>
                <div class="p-3 bg-white/70 rounded-xl shadow-xs border border-amber-200/60">
                  <div class="text-xl md:text-2xl font-bold font-divine text-sacred-800">15+</div>
                  <div class="text-xs text-stone-600 font-medium">वर्षों का अनुभव</div>
                </div>
                <div class="p-3 bg-white/70 rounded-xl shadow-xs border border-amber-200/60">
                  <div class="text-xl md:text-2xl font-bold font-divine text-sacred-800">10,000+</div>
                  <div class="text-xs text-stone-600 font-medium">संतुष्ट यजमान</div>
                </div>
              </div>
            </div>

            <!-- Hero Image & Shastri Card -->
            <div class="lg:col-span-5">
              <div class="relative mx-auto max-w-md">
                <div class="absolute -inset-1.5 bg-gradient-to-r from-amber-500 to-sacred-700 rounded-3xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-pulse"></div>
                <div class="relative glass-card rounded-2xl overflow-hidden border border-amber-200 shadow-xl">
                  <img src="uploads/pandits/pandits_1789879471_309e213c.jpg" 
                       alt="Pandit Shyam Geete" 
                       class="w-full h-80 object-cover"
                       onerror="this.src='https://images.unsplash.com/photo-1544816155-12df9643f363?w=500&auto=format&fit=crop&q=80'" />
                  <div class="p-5 bg-white/95">
                    <div class="flex items-center justify-between mb-1">
                      <h3 class="font-bold text-lg text-sacred-900">{{ currentLang === 'hi' ? SITE_CONFIG.head_priest_hi : SITE_CONFIG.head_priest_en }}</h3>
                      <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 text-xs font-bold">⭐ 5.0 (प्रमाणित)</span>
                    </div>
                    <p class="text-xs text-sacred-600 font-medium mb-3">तीर्थ पुरोहित • वैदिक ज्योतिषाचार्य</p>
                    <p class="text-xs text-stone-600 mb-4 line-clamp-2">
                      ओंकारेश्वर ज्योतिर्लिंग तीर्थ पर सविधि रुद्राभिषेक, कालसर्प शांति एवं नर्मदा पूजन के मुख्य संचालक।
                    </p>
                    <div class="flex items-center gap-2">
                      <a :href="'tel:' + SITE_CONFIG.primary_phone" class="flex-1 py-2 rounded-lg bg-amber-100 text-sacred-800 text-center font-bold text-xs hover:bg-amber-200 transition">
                        📞 {{ t.call_now }}
                      </a>
                      <a :href="'https://wa.me/' + SITE_CONFIG.whatsapp_number" target="_blank" class="flex-1 py-2 rounded-lg bg-emerald-600 text-white text-center font-bold text-xs hover:bg-emerald-700 transition">
                        💬 WhatsApp
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      <!-- SECTION: POOJA SERVICES (Categorized & Packages) -->
      <section id="poojas-section" class="py-16 md:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
          <div class="inline-block px-3 py-1 rounded-full bg-amber-100 text-sacred-800 text-xs font-bold uppercase tracking-wider mb-2">
            🔱 {{ t.nav_pooja }}
          </div>
          <h2 class="text-2xl md:text-4xl font-extrabold font-divine text-sacred-900 mb-4">
            श्री ओंकारेश्वर ज्योतिर्लिंग पूजा एवं अनुष्ठान
          </h2>
          <p class="text-stone-600 text-sm md:text-base">
            शास्त्रोक्त विधि-विधान से संपन्न होने वाली पवित्र पूजा सेवाएँ। अपनी आवश्यकतानुसार पैकेज चुनें और संकल्प कराएं।
          </p>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-4 mb-8 justify-start sm:justify-center">
          <button @click="selectedCategorySlug = 'all'" 
                  class="px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition whitespace-nowrap shadow-xs"
                  :class="selectedCategorySlug === 'all' ? 'bg-sacred-700 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            {{ t.cat_all }}
          </button>
          <button v-for="cat in categories" :key="cat.id" 
                  @click="selectedCategorySlug = cat.slug"
                  class="px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition whitespace-nowrap shadow-xs"
                  :class="selectedCategorySlug === cat.slug ? 'bg-sacred-700 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            {{ currentLang === 'hi' ? cat.name_hi : cat.name_en }}
          </button>
        </div>

        <!-- Pooja Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="pooja in filteredPoojas" :key="pooja.id" 
               class="glass-card rounded-2xl overflow-hidden border border-amber-200/80 shadow-sm hover:shadow-sacred transition-all flex flex-col group">
            
            <!-- Image & Badge -->
            <div class="relative h-52 overflow-hidden bg-amber-50">
              <img :src="pooja.image_url" 
                   :alt="pooja.name_hi" 
                   class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                   onerror="this.src='https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80'" />
              <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-sacred-800/90 backdrop-blur-md text-amber-200 text-xs font-bold">
                {{ currentLang === 'hi' ? (pooja.category_name_hi || 'वैदिक पूजा') : (pooja.category_name_en || 'Vedic Pooja') }}
              </div>
              <div v-if="pooja.starting_price > 0" class="absolute bottom-3 right-3 px-3 py-1 rounded-lg bg-amber-500 text-white font-extrabold text-xs shadow-md">
                {{ t.starting_from }} ₹{{ pooja.starting_price }}
              </div>
            </div>

            <!-- Content -->
            <div class="p-6 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="font-bold text-lg md:text-xl font-divine text-sacred-900 mb-2 group-hover:text-sacred-600 transition">
                  {{ currentLang === 'hi' ? pooja.name_hi : pooja.name_en }}
                </h3>
                <p class="text-xs sm:text-sm text-stone-600 line-clamp-3 mb-4 leading-relaxed">
                  {{ currentLang === 'hi' ? pooja.description_hi : pooja.description_en }}
                </p>

                <!-- Variations / Packages Quick List -->
                <div v-if="pooja.variations && pooja.variations.length > 0" class="space-y-1.5 mb-5 bg-amber-50/70 p-3 rounded-xl border border-amber-200/60">
                  <div v-for="v in pooja.variations.slice(0, 2)" :key="v.id" class="flex items-center justify-between text-xs font-medium text-sacred-900">
                    <span>✨ {{ currentLang === 'hi' ? v.title_hi : v.title_en }}</span>
                    <span class="font-bold text-sacred-700">₹{{ v.price }}</span>
                  </div>
                  <div v-if="pooja.variations.length > 2" class="text-2xs text-stone-500 text-right italic">
                    + {{ pooja.variations.length - 2 }} अन्य पैकेज उपलब्ध
                  </div>
                </div>
              </div>

              <!-- Action Button -->
              <div class="pt-2">
                <button @click="openVariationModal(pooja)" 
                        class="w-full py-3 rounded-xl saffron-gradient-bg text-white font-bold text-sm shadow hover:shadow-sacred transition flex items-center justify-center gap-2">
                  <span>🔱</span>
                  <span>{{ t.select_variation }}</span>
                </button>
              </div>
            </div>

          </div>
        </div>

        <!-- Custom Anushthan Banner -->
        <div class="mt-14 sacred-gradient-bg text-white rounded-3xl p-8 md:p-12 shadow-sacred-lg relative overflow-hidden">
          <div class="relative z-10 max-w-3xl">
            <h3 class="text-2xl md:text-3xl font-extrabold font-divine mb-3 text-amber-100">
              {{ t.custom_anushthan_title }}
            </h3>
            <p class="text-sm md:text-base text-amber-50/90 mb-6 leading-relaxed">
              {{ t.custom_anushthan_desc }}
            </p>
            <a :href="'https://wa.me/' + SITE_CONFIG.whatsapp_number + '?text=' + encodeURIComponent('जय ओंकारेश्वर शास्त्री जी, मुझे विशेष व्यक्तिगत अनुष्ठान हेतु बात करनी है।')" 
               target="_blank"
               class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-sacred-900 font-bold px-6 py-3.5 rounded-xl shadow-lg transition text-sm">
              <span>💬</span>
              <span>{{ t.custom_anushthan_btn }}</span>
            </a>
          </div>
        </div>
      </section>

      <!-- SECTION: VIDWAN PANDITS & PUROHIT MANDAL -->
      <section id="pandits-section" class="py-16 md:py-24 sacred-texture-bg border-y border-amber-900/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-block px-3 py-1 rounded-full bg-amber-100 text-sacred-800 text-xs font-bold uppercase tracking-wider mb-2">
              🙏 {{ t.nav_pandits }}
            </div>
            <h2 class="text-2xl md:text-4xl font-extrabold font-divine text-sacred-900 mb-3">
              {{ t.pandits_title }}
            </h2>
            <p class="text-stone-600 text-sm md:text-base">
              {{ t.pandits_sub }}
            </p>
          </div>

          <!-- Pandits Cards Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="pandit in activePandits" :key="pandit.id" 
                 class="glass-card rounded-2xl overflow-hidden border border-amber-200/80 shadow-sm hover:shadow-sacred transition flex flex-col justify-between">
              <div>
                <div class="p-6 text-center border-b border-amber-100 bg-gradient-to-b from-amber-50/60 to-transparent">
                  <img :src="pandit.image_url" 
                       :alt="pandit.name_hi" 
                       class="w-28 h-28 mx-auto rounded-full object-cover border-4 border-amber-400 shadow-md mb-4"
                       onerror="this.src='https://images.unsplash.com/photo-1544816155-12df9643f363?w=500&auto=format&fit=crop&q=80'" />
                  <h3 class="text-xl font-bold font-divine text-sacred-900 mb-1">
                    {{ currentLang === 'hi' ? pandit.name_hi : pandit.name_en }}
                  </h3>
                  <div class="text-xs font-semibold text-sacred-600 mb-2">
                    {{ currentLang === 'hi' ? pandit.title_hi : pandit.title_en }}
                  </div>
                  
                  <!-- Rating & Reviews -->
                  <div class="flex items-center justify-center gap-2 text-xs font-bold text-amber-700 bg-amber-100/70 py-1 px-3 rounded-full w-max mx-auto">
                    <span>⭐ {{ Number(pandit.rating).toFixed(1) }}</span>
                    <span class="text-stone-400">•</span>
                    <span>{{ pandit.reviews_count }} {{ t.reviews_count_suffix }}</span>
                  </div>
                </div>

                <div class="p-6 space-y-3 text-xs sm:text-sm text-stone-700">
                  <div class="flex items-center justify-between pb-2 border-b border-amber-100">
                    <span class="text-stone-500 font-medium">अनुभव:</span>
                    <span class="font-bold text-sacred-900">{{ pandit.experience_years }} {{ t.experience_suffix }}</span>
                  </div>
                  <div class="pb-2 border-b border-amber-100">
                    <span class="text-stone-500 font-medium block mb-1">विशेषज्ञता:</span>
                    <span class="font-semibold text-sacred-800">{{ currentLang === 'hi' ? pandit.specialization_hi : pandit.specialization_en }}</span>
                  </div>
                  <div v-if="pandit.bio_hi || pandit.bio_en" class="text-xs text-stone-600 leading-relaxed pt-1">
                    {{ currentLang === 'hi' ? pandit.bio_hi : pandit.bio_en }}
                  </div>
                </div>
              </div>

              <!-- Pandit Consultation Actions -->
              <div class="p-6 pt-0 flex gap-2">
                <a :href="pandit.whatsapp_direct_url || ('https://wa.me/' + (pandit.whatsapp_number || '919977557063'))" 
                   target="_blank"
                   class="flex-1 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-center font-bold text-xs shadow transition flex items-center justify-center gap-1.5">
                  <span>💬</span>
                  <span>{{ t.consult_pandit }}</span>
                </a>
                <a :href="'tel:' + (pandit.phone || '9977557063')" 
                   class="px-4 py-2.5 rounded-xl bg-amber-100 hover:bg-amber-200 text-sacred-800 font-bold text-xs transition flex items-center justify-center">
                  📞
                </a>
              </div>

            </div>
          </div>
        </div>
      </section>

      <!-- SECTION: TRUST & AUTHENTICITY BADGES -->
      <section class="py-14 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
          <h2 class="text-xl md:text-3xl font-extrabold font-divine text-sacred-900 mb-2">
            {{ t.trust_section_title }}
          </h2>
          <p class="text-xs md:text-sm text-stone-600">{{ t.trust_section_sub }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="glass-card p-6 rounded-2xl border border-amber-200 text-center shadow-xs">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-sacred-700 text-2xl flex items-center justify-center mx-auto mb-4">
              🪔
            </div>
            <h4 class="font-bold text-sm md:text-base text-sacred-900 mb-2">{{ t.trust_badge_1_title }}</h4>
            <p class="text-xs text-stone-600 leading-relaxed">{{ t.trust_badge_1_desc }}</p>
          </div>

          <div class="glass-card p-6 rounded-2xl border border-amber-200 text-center shadow-xs">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-sacred-700 text-2xl flex items-center justify-center mx-auto mb-4">
              🕉️
            </div>
            <h4 class="font-bold text-sm md:text-base text-sacred-900 mb-2">{{ t.trust_badge_2_title }}</h4>
            <p class="text-xs text-stone-600 leading-relaxed">{{ t.trust_badge_2_desc }}</p>
          </div>

          <div class="glass-card p-6 rounded-2xl border border-amber-200 text-center shadow-xs">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-sacred-700 text-2xl flex items-center justify-center mx-auto mb-4">
              🌊
            </div>
            <h4 class="font-bold text-sm md:text-base text-sacred-900 mb-2">{{ t.trust_badge_3_title }}</h4>
            <p class="text-xs text-stone-600 leading-relaxed">{{ t.trust_badge_3_desc }}</p>
          </div>

          <div class="glass-card p-6 rounded-2xl border border-amber-200 text-center shadow-xs">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-sacred-700 text-2xl flex items-center justify-center mx-auto mb-4">
              📱
            </div>
            <h4 class="font-bold text-sm md:text-base text-sacred-900 mb-2">{{ t.trust_badge_4_title }}</h4>
            <p class="text-xs text-stone-600 leading-relaxed">{{ t.trust_badge_4_desc }}</p>
          </div>
        </div>
      </section>

      <!-- SECTION: SPIRITUAL BLOGS & PANCHANG -->
      <section id="blogs-section" class="py-16 md:py-24 sacred-texture-bg border-t border-amber-900/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-block px-3 py-1 rounded-full bg-amber-100 text-sacred-800 text-xs font-bold uppercase tracking-wider mb-2">
              📖 {{ t.nav_blogs }}
            </div>
            <h2 class="text-2xl md:text-4xl font-extrabold font-divine text-sacred-900 mb-3">
              {{ t.daily_blogs_title }}
            </h2>
            <p class="text-stone-600 text-sm md:text-base">
              {{ t.daily_blogs_sub }}
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <article v-for="blog in publishedBlogs" :key="blog.id" 
                     class="glass-card rounded-2xl overflow-hidden border border-amber-200/80 shadow-sm hover:shadow-sacred transition flex flex-col justify-between">
              <div>
                <div class="h-48 overflow-hidden bg-amber-100">
                  <img :src="blog.image_url" 
                       :alt="blog.title_hi" 
                       class="w-full h-full object-cover hover:scale-105 transition duration-500"
                       onerror="this.src='https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80'" />
                </div>
                <div class="p-6">
                  <div class="text-2xs font-semibold text-sacred-600 uppercase tracking-wider mb-2">
                    {{ new Date(blog.created_at || Date.now()).toLocaleDateString('hi-IN', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                  </div>
                  <h3 class="font-bold text-lg font-divine text-sacred-900 mb-3 line-clamp-2">
                    {{ currentLang === 'hi' ? blog.title_hi : blog.title_en }}
                  </h3>
                  <p class="text-xs sm:text-sm text-stone-600 line-clamp-3 leading-relaxed">
                    {{ currentLang === 'hi' ? blog.content_hi : blog.content_en }}
                  </p>
                </div>
              </div>

              <div class="p-6 pt-0">
                <button @click="openBlogDetails(blog)" 
                        class="w-full py-2.5 rounded-xl border border-sacred-600 text-sacred-700 hover:bg-amber-50 font-bold text-xs transition">
                  {{ t.read_more }} →
                </button>
              </div>
            </article>
          </div>
        </div>
      </section>

      <!-- SECTION: DIRECT CONTACT & DEVOTEES SANKALP FORM -->
      <section id="contact-section" class="py-16 md:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
          
          <!-- Contact Info Column -->
          <div class="lg:col-span-5 space-y-6">
            <div class="inline-block px-3 py-1 rounded-full bg-amber-100 text-sacred-800 text-xs font-bold uppercase tracking-wider">
              📞 {{ t.nav_contact }}
            </div>
            <h2 class="text-2xl md:text-3xl font-extrabold font-divine text-sacred-900">
              {{ t.hotline_title }}
            </h2>
            <p class="text-stone-600 text-sm leading-relaxed">
              {{ t.hotline_sub }}
            </p>

            <div class="space-y-4 pt-2">
              <div class="p-4 rounded-xl bg-white border border-amber-200 flex items-start gap-4 shadow-xs">
                <div class="w-10 h-10 rounded-lg bg-amber-100 text-sacred-700 text-xl flex items-center justify-center shrink-0">
                  📍
                </div>
                <div>
                  <div class="font-bold text-sm text-sacred-900">तीर्थ निवास एवं संपर्क पता</div>
                  <div class="text-xs text-stone-600 mt-0.5">{{ t.temple_location }}</div>
                  <a :href="SITE_CONFIG.google_maps_url" target="_blank" class="text-xs text-sacred-600 font-bold mt-1 inline-block hover:underline">
                    {{ t.get_directions }} →
                  </a>
                </div>
              </div>

              <div class="p-4 rounded-xl bg-white border border-amber-200 flex items-start gap-4 shadow-xs">
                <div class="w-10 h-10 rounded-lg bg-amber-100 text-sacred-700 text-xl flex items-center justify-center shrink-0">
                  📞
                </div>
                <div>
                  <div class="font-bold text-sm text-sacred-900">सीधा कॉल परामर्श</div>
                  <div class="text-xs text-stone-600 mt-0.5">{{ SITE_CONFIG.primary_phone }}</div>
                  <a :href="'tel:' + SITE_CONFIG.primary_phone" class="text-xs text-emerald-700 font-bold mt-1 inline-block hover:underline">
                    अभी कॉल करें →
                  </a>
                </div>
              </div>

              <div class="p-4 rounded-xl bg-white border border-amber-200 flex items-start gap-4 shadow-xs">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-700 text-xl flex items-center justify-center shrink-0">
                  💬
                </div>
                <div>
                  <div class="font-bold text-sm text-sacred-900">व्हाट्सएप हेल्पलाइन</div>
                  <div class="text-xs text-stone-600 mt-0.5">+{{ SITE_CONFIG.whatsapp_number }}</div>
                  <a :href="'https://wa.me/' + SITE_CONFIG.whatsapp_number" target="_blank" class="text-xs text-emerald-700 font-bold mt-1 inline-block hover:underline">
                    व्हाट्सएप पर बात करें →
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Devotee Booking & Sankalp Form -->
          <div id="booking-section" class="lg:col-span-7">
            <div class="glass-card rounded-3xl p-6 sm:p-8 border border-amber-200/90 shadow-sacred">
              <h3 class="text-xl md:text-2xl font-bold font-divine text-sacred-900 mb-2">
                {{ t.quick_inquiry_title }}
              </h3>
              <p class="text-xs text-stone-600 mb-6">
                कृपया अपना विवरण दर्ज करें ताकि शास्त्री जी आपके गोत्र अनुसार शास्त्रोक्त संकल्प दर्ज कर सकें।
              </p>

              <form @submit.prevent="submitBooking" class="space-y-4">
                
                <!-- Pooja Selection -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-xs font-bold text-sacred-900 mb-1">पूजा सेवा चुनें *</label>
                    <select v-model="bookingForm.pooja_id" required class="w-full text-xs sm:text-sm p-3 rounded-xl border border-amber-300 bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none">
                      <option value="" disabled>-- पूजा चुनें --</option>
                      <option v-for="p in poojas" :key="p.id" :value="p.id">
                        {{ currentLang === 'hi' ? p.name_hi : p.name_en }}
                      </option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-xs font-bold text-sacred-900 mb-1">इच्छित तिथि *</label>
                    <input type="date" v-model="bookingForm.pooja_date" required class="w-full text-xs sm:text-sm p-3 rounded-xl border border-amber-300 bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" />
                  </div>
                </div>

                <!-- Devotee Name & Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-xs font-bold text-sacred-900 mb-1">{{ t.form_full_name }}</label>
                    <input type="text" v-model="bookingForm.devotee_name" required placeholder="जैसे: राहुल शर्मा" class="w-full text-xs sm:text-sm p-3 rounded-xl border border-amber-300 bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" />
                  </div>
                  <div>
                    <label class="block text-xs font-bold text-sacred-900 mb-1">{{ t.form_phone }}</label>
                    <input type="tel" v-model="bookingForm.phone" required placeholder="10 अंकों का मोबाइल नंबर" class="w-full text-xs sm:text-sm p-3 rounded-xl border border-amber-300 bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" />
                  </div>
                </div>

                <!-- WhatsApp & Gotra -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-xs font-bold text-sacred-900 mb-1">{{ t.form_whatsapp }}</label>
                    <input type="tel" v-model="bookingForm.whatsapp_number" placeholder="व्हाट्सएप नंबर (फोटो/वीडियो हेतु)" class="w-full text-xs sm:text-sm p-3 rounded-xl border border-amber-300 bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" />
                  </div>
                  <div>
                    <label class="block text-xs font-bold text-sacred-900 mb-1">{{ t.form_gotra }}</label>
                    <input type="text" v-model="bookingForm.gotra" placeholder="जैसे: कश्यप, भारद्वाज" class="w-full text-xs sm:text-sm p-3 rounded-xl border border-amber-300 bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none" />
                  </div>
                </div>

                <!-- Special Wishes / Sankalp notes -->
                <div>
                  <label class="block text-xs font-bold text-sacred-900 mb-1">{{ t.form_wishes }}</label>
                  <textarea v-model="bookingForm.special_wishes" rows="2" placeholder="मनोकामना, परिवार के सदस्यों के नाम या कोई विशेष प्रार्थना..." class="w-full text-xs sm:text-sm p-3 rounded-xl border border-amber-300 bg-white focus:ring-2 focus:ring-amber-500 focus:outline-none"></textarea>
                </div>

                <!-- Submit CTA -->
                <button type="submit" 
                        :disabled="isSubmittingBooking"
                        class="w-full py-4 rounded-xl saffron-gradient-bg text-white font-bold text-base shadow-sacred hover:shadow-sacred-lg transition flex items-center justify-center gap-2">
                  <span>{{ isSubmittingBooking ? '⏳' : '🔱' }}</span>
                  <span>{{ isSubmittingBooking ? t.submitting : t.form_submit }}</span>
                </button>
              </form>
            </div>
          </div>

        </div>
      </section>

    </main>

    <!-- ================================================================= -->
    <!-- VIEW 2: ADMIN CMS MANAGEMENT PORTAL                               -->
    <!-- ================================================================= -->
    <main v-else-if="currentView === 'admin'" class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
      
      <!-- ADMIN LOGIN SCREEN (If not authenticated) -->
      <div v-if="!authToken" class="max-w-md mx-auto my-12 glass-card p-8 rounded-3xl border border-amber-300 shadow-2xl">
        <div class="text-center mb-8">
          <div class="w-16 h-16 rounded-full bg-sacred-800 text-white text-3xl font-bold flex items-center justify-center mx-auto mb-3 shadow-sacred">
            🔒
          </div>
          <h2 class="text-2xl font-bold font-divine text-sacred-900">व्यवस्थापक लॉगिन (Admin)</h2>
          <p class="text-xs text-stone-600 mt-1">पंडित श्याम गीते पोर्टल का सुरक्षित प्रबंधन</p>
        </div>

        <form @submit.prevent="handleLogin" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">व्यवस्थापक ईमेल (Email)</label>
            <input type="email" v-model="loginForm.email" required class="w-full text-sm p-3 rounded-xl border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:outline-none" />
          </div>
          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">पासवर्ड (Password)</label>
            <input type="password" v-model="loginForm.password" required placeholder="••••••••" class="w-full text-sm p-3 rounded-xl border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:outline-none" />
          </div>
          <button type="submit" 
                  :disabled="isLoggingIn"
                  class="w-full py-3.5 rounded-xl sacred-gradient-bg text-white font-bold text-sm shadow-sacred hover:shadow-sacred-lg transition">
            {{ isLoggingIn ? 'प्रमाणीकरण हो रहा है...' : 'लॉगिन करें (Secure Login)' }}
          </button>
        </form>
      </div>

      <!-- ADMIN DASHBOARD (When authenticated) -->
      <div v-else class="space-y-6">
        
        <!-- Admin Dashboard Header -->
        <div class="glass-card p-6 rounded-2xl border border-amber-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-sm">
          <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold mb-1">
              <span>●</span> <span>सक्रिय व्यवस्थापक सत्र (Admin Logged In)</span>
            </div>
            <h2 class="text-xl md:text-2xl font-bold font-divine text-sacred-900">
              {{ t.admin_portal_title }}
            </h2>
          </div>
          <div class="flex items-center gap-3">
            <button @click="navigateTo('home')" class="px-4 py-2 rounded-xl bg-amber-100 text-sacred-800 text-xs font-bold hover:bg-amber-200 transition">
              🏠 वेबसाइट देखें (View Site)
            </button>
            <button @click="handleLogout" class="px-4 py-2 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-700 transition">
              🚪 {{ t.logout }}
            </button>
          </div>
        </div>

        <!-- CMS Tab Buttons -->
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2">
          <button @click="activeAdminTab = 'crm'" 
                  class="px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold transition whitespace-nowrap shadow-xs"
                  :class="activeAdminTab === 'crm' ? 'bg-sacred-800 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            📋 {{ t.tab_crm }} ({{ (bookings || []).length }})
          </button>
          <button @click="activeAdminTab = 'poojas'" 
                  class="px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold transition whitespace-nowrap shadow-xs"
                  :class="activeAdminTab === 'poojas' ? 'bg-sacred-800 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            🔱 {{ t.tab_poojas }} ({{ (poojas || []).length }})
          </button>
          <button @click="activeAdminTab = 'pandits'" 
                  class="px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold transition whitespace-nowrap shadow-xs"
                  :class="activeAdminTab === 'pandits' ? 'bg-sacred-800 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            🙏 {{ t.tab_pandits }} ({{ (pandits || []).length }})
          </button>
          <button @click="activeAdminTab = 'blogs'" 
                  class="px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold transition whitespace-nowrap shadow-xs"
                  :class="activeAdminTab === 'blogs' ? 'bg-sacred-800 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            📖 {{ t.tab_blogs }} ({{ (blogs || []).length }})
          </button>
          <button @click="activeAdminTab = 'categories'" 
                  class="px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold transition whitespace-nowrap shadow-xs"
                  :class="activeAdminTab === 'categories' ? 'bg-sacred-800 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            🏷️ {{ t.tab_categories }} ({{ (categories || []).length }})
          </button>
          <button @click="activeAdminTab = 'settings'" 
                  class="px-4 py-2.5 rounded-xl text-xs md:text-sm font-bold transition whitespace-nowrap shadow-xs"
                  :class="activeAdminTab === 'settings' ? 'bg-sacred-800 text-white' : 'bg-white text-stone-700 hover:bg-amber-50 border border-amber-200'">
            ⚙️ {{ t.tab_settings }}
          </button>
        </div>

        <!-- TAB 1: DEVOTEES CRM (Bookings) -->
        <div v-if="activeAdminTab === 'crm'" class="space-y-4">
          <div class="glass-card p-4 rounded-2xl border border-amber-200 flex flex-col md:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2 w-full md:w-auto">
              <span class="text-xs font-bold text-sacred-900 whitespace-nowrap">{{ t.filter_by_date }}</span>
              <button @click="crmDateFilter = 'all'" 
                      class="px-3 py-1.5 rounded-lg text-xs font-bold transition"
                      :class="crmDateFilter === 'all' ? 'bg-sacred-800 text-white' : 'bg-amber-100 text-sacred-900'">
                {{ t.all_dates }}
              </button>
              <button @click="crmDateFilter = 'today'" 
                      class="px-3 py-1.5 rounded-lg text-xs font-bold transition"
                      :class="crmDateFilter === 'today' ? 'bg-sacred-800 text-white' : 'bg-amber-100 text-sacred-900'">
                {{ t.today }}
              </button>
            </div>
            <div class="w-full md:w-72">
              <input type="text" v-model="crmSearchQuery" :placeholder="t.search_devotees" class="w-full text-xs p-2.5 rounded-xl border border-amber-300 focus:ring-2 focus:ring-amber-500 focus:outline-none" />
            </div>
          </div>

          <!-- Bookings Table / Cards -->
          <div class="glass-card rounded-2xl border border-amber-200 overflow-hidden shadow-sm">
            <div v-if="!filteredBookings || filteredBookings.length === 0" class="p-12 text-center text-stone-500 text-sm font-medium">
              कोई बुकिंग रिकॉर्ड नहीं मिला।
            </div>
            <div v-else class="overflow-x-auto">
              <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-amber-100/70 text-sacred-900 font-bold border-b border-amber-200">
                  <tr>
                    <th class="p-3.5">ID / तिथि</th>
                    <th class="p-3.5">यजमान विवरण</th>
                    <th class="p-3.5">पूजा एवं पैकेज</th>
                    <th class="p-3.5">स्थिति (Status)</th>
                    <th class="p-3.5 text-right">त्वरित संपर्क</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-amber-100">
                  <tr v-for="b in filteredBookings" :key="b.id" class="hover:bg-amber-50/50 transition">
                    <td class="p-3.5">
                      <div class="font-bold text-sacred-800">#{{ b.id }}</div>
                      <div class="text-xs text-stone-500">{{ b.preferred_date || b.pooja_date }}</div>
                    </td>
                    <td class="p-3.5">
                      <div class="font-bold text-sacred-900">{{ b.full_name || b.devotee_name }}</div>
                      <div class="text-xs text-stone-500">गोत्र: {{ b.gotra || 'कश्यप' }}</div>
                      <div class="text-xs text-stone-500">📞 {{ b.phone }}</div>
                    </td>
                    <td class="p-3.5">
                      <div class="font-semibold text-sacred-800">{{ b.pooja_name_hi || b.pooja_name_en || b.pooja_name || 'वैदिक पूजा' }}</div>
                      <div class="text-xs text-emerald-700 font-bold">{{ b.variation_title_hi ? b.variation_title_hi + ' - ' : '' }}₹{{ b.variation_price || b.amount || b.price || 0 }}</div>
                      <div v-if="b.special_wishes" class="text-2xs text-stone-500 mt-1 italic line-clamp-1">"{{ b.special_wishes }}"</div>
                    </td>
                    <td class="p-3.5">
                      <select :value="b.status || 'Pending'" 
                              @change="updateBookingStatus(b.id, $event.target.value)"
                              class="text-xs p-1.5 rounded-lg font-bold border border-amber-300 bg-white">
                        <option value="Pending">⏳ Pending (लंबित)</option>
                        <option value="Sankalp Done">🕉️ Sankalp Done</option>
                        <option value="Prasad Sent">📦 Prasad Sent</option>
                        <option value="Completed">✅ Completed</option>
                      </select>
                    </td>
                    <td class="p-3.5 text-right space-x-1 whitespace-nowrap">
                      <a :href="b.whatsapp_direct_url || ('https://wa.me/' + (b.whatsapp_number ? b.whatsapp_number.replace(/[^0-9]/g, '') : (b.phone ? b.phone.replace(/[^0-9]/g, '') : '919977557063')) + '?text=' + encodeURIComponent('सादर प्रणाम ' + (b.full_name || b.devotee_name) + ' जी! ओंकारेश्वर ज्योतिर्लिंग से पंडित श्याम गीते जी द्वारा आपकी पूजा का संकल्प विवरण:'))" 
                         target="_blank"
                         class="inline-block px-2.5 py-1.5 rounded bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs">
                        💬 WA
                      </a>
                      <a :href="'tel:' + (b.phone || b.whatsapp_number)" class="inline-block px-2.5 py-1.5 rounded bg-amber-100 hover:bg-amber-200 text-sacred-900 font-bold text-xs">
                        📞 Call
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        </div>

        <!-- TAB 2: POOJAS MANAGEMENT -->
        <div v-if="activeAdminTab === 'poojas'" class="space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold font-divine text-sacred-900">पूजा सेवाएँ एवं पैकेज प्रबंधन</h3>
            <button @click="openPoojaModal()" class="px-4 py-2 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.add_new_pooja }}
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="p in poojas" :key="p.id" class="glass-card rounded-2xl border border-amber-200 overflow-hidden shadow-xs flex flex-col justify-between">
              <div>
                <div class="h-40 relative bg-amber-50">
                  <img :src="p.image_url" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80'" />
                  <span class="absolute top-2 right-2 px-2 py-0.5 rounded text-xs font-bold"
                        :class="p.is_active == 1 ? 'bg-emerald-600 text-white' : 'bg-stone-500 text-white'">
                    {{ p.is_active == 1 ? 'सक्रिय (Active)' : 'निष्क्रिय' }}
                  </span>
                </div>
                <div class="p-4">
                  <h4 class="font-bold text-base text-sacred-900">{{ p.name_hi }}</h4>
                  <div class="text-xs text-stone-500 mb-2">{{ p.name_en }}</div>
                  <div class="text-xs text-stone-600 line-clamp-2 mb-3">{{ p.description_hi }}</div>
                  
                  <div class="bg-amber-50 p-2.5 rounded-lg border border-amber-200 text-xs">
                    <span class="font-bold text-sacred-800">पैकेज ({{ (p.variations || []).length }}):</span>
                    <div v-for="v in p.variations" :key="v.id" class="flex justify-between mt-1 text-2xs">
                      <span>• {{ v.title_hi }}</span>
                      <span class="font-bold">₹{{ v.price }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="p-4 pt-0 flex gap-2">
                <button @click="openPoojaModal(p)" class="flex-1 py-2 rounded-lg bg-amber-100 hover:bg-amber-200 text-sacred-900 font-bold text-xs">
                  ✏️ संपादित करें
                </button>
                <button @click="deletePoojaProfile(p.id)" class="px-3 py-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs">
                  🗑️
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- TAB 3: PANDITS MANAGEMENT & RATINGS -->
        <div v-if="activeAdminTab === 'pandits'" class="space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold font-divine text-sacred-900">विद्वान पुरोहित मंडल एवं रेटिंग</h3>
            <button @click="openPanditModal()" class="px-4 py-2 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.add_new_pandit }}
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="p in pandits" :key="p.id" class="glass-card rounded-2xl border border-amber-200 p-5 shadow-xs flex flex-col justify-between">
              <div>
                <div class="flex items-center gap-4 mb-4">
                  <img :src="p.image_url" class="w-16 h-16 rounded-full object-cover border-2 border-amber-400 shadow" onerror="this.src='https://images.unsplash.com/photo-1544816155-12df9643f363?w=500&auto=format&fit=crop&q=80'" />
                  <div>
                    <h4 class="font-bold text-base text-sacred-900">{{ p.name_hi }}</h4>
                    <div class="text-xs text-stone-500">{{ p.title_hi }}</div>
                    <div class="text-xs font-bold text-amber-700 mt-1">⭐ {{ Number(p.rating).toFixed(1) }} ({{ p.reviews_count }} रिव्यू)</div>
                  </div>
                </div>

                <div class="space-y-1.5 text-xs text-stone-600 mb-4">
                  <div><strong>अनुभव:</strong> {{ p.experience_years }} वर्ष</div>
                  <div><strong>विशेषज्ञता:</strong> {{ p.specialization_hi }}</div>
                  <div><strong>फोन/WA:</strong> {{ p.phone }} / {{ p.whatsapp_number }}</div>
                </div>
              </div>

              <div class="flex gap-2">
                <button @click="openPanditModal(p)" class="flex-1 py-2 rounded-lg bg-amber-100 hover:bg-amber-200 text-sacred-900 font-bold text-xs">
                  ✏️ संपादित करें
                </button>
                <button @click="deletePanditProfile(p.id)" class="px-3 py-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs">
                  🗑️
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- TAB 4: BLOGS MANAGEMENT -->
        <div v-if="activeAdminTab === 'blogs'" class="space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold font-divine text-sacred-900">आध्यात्मिक लेख एवं पंचांग सामग्री</h3>
            <button @click="openBlogEditModal()" class="px-4 py-2 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.add_new_blog }}
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="b in blogs" :key="b.id" class="glass-card rounded-2xl border border-amber-200 p-5 shadow-xs flex flex-col justify-between">
              <div>
                <img :src="b.image_url" class="w-full h-36 rounded-xl object-cover mb-3" onerror="this.src='https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80'" />
                <h4 class="font-bold text-base text-sacred-900 mb-1">{{ b.title_hi }}</h4>
                <p class="text-xs text-stone-600 line-clamp-3 mb-3">{{ b.content_hi }}</p>
              </div>

              <div class="flex gap-2">
                <button @click="openBlogEditModal(b)" class="flex-1 py-2 rounded-lg bg-amber-100 hover:bg-amber-200 text-sacred-900 font-bold text-xs">
                  ✏️ संपादित करें
                </button>
                <button @click="deleteBlogArticle(b.id)" class="px-3 py-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs">
                  🗑️
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- TAB 5: CATEGORIES MANAGEMENT -->
        <div v-if="activeAdminTab === 'categories'" class="space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold font-divine text-sacred-900">पूजा श्रेणियाँ</h3>
            <button @click="openCategoryModal()" class="px-4 py-2 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.add_new_cat }}
            </button>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="c in categories" :key="c.id" class="glass-card p-4 rounded-xl border border-amber-200 flex items-center justify-between shadow-xs">
              <div>
                <h4 class="font-bold text-sm text-sacred-900">{{ c.name_hi }}</h4>
                <div class="text-xs text-stone-500">{{ c.name_en }} ({{ c.slug }})</div>
              </div>
              <button @click="openCategoryModal(c)" class="p-2 text-sacred-700 hover:bg-amber-100 rounded-lg">
                ✏️
              </button>
            </div>
          </div>
        </div>

        <!-- TAB 6: SETTINGS & PASSWORD CHANGE -->
        <div v-if="activeAdminTab === 'settings'" class="space-y-6">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Site Contact Info Settings -->
            <div class="glass-card p-6 rounded-2xl border border-amber-200">
              <h3 class="text-lg font-bold font-divine text-sacred-900 mb-4">संपर्क एवं आरती सेटिंग्स</h3>
              <div class="space-y-3 text-xs sm:text-sm text-stone-700">
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200">
                  <span class="font-bold text-sacred-900">मुख्य आचार्य:</span> {{ SITE_CONFIG.head_priest_hi }}
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200">
                  <span class="font-bold text-sacred-900">हेल्पलाइन फोन:</span> {{ SITE_CONFIG.primary_phone }}
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200">
                  <span class="font-bold text-sacred-900">व्हाट्सएप:</span> +{{ SITE_CONFIG.whatsapp_number }}
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200">
                  <span class="font-bold text-sacred-900">तीर्थ पता:</span> {{ SITE_CONFIG.temple_address_hi }}
                </div>
              </div>
            </div>

            <!-- Password Change Form -->
            <div class="glass-card p-6 rounded-2xl border border-amber-200">
              <h3 class="text-lg font-bold font-divine text-sacred-900 mb-4">व्यवस्थापक पासवर्ड बदलें</h3>
              <form @submit.prevent="changeAdminPassword" class="space-y-3">
                <div>
                  <label class="block text-xs font-bold text-sacred-900 mb-1">वर्तमान पासवर्ड *</label>
                  <input type="password" v-model="passwordChangeForm.old_password" required class="w-full text-xs sm:text-sm p-2.5 rounded-xl border border-amber-300 focus:outline-none" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-sacred-900 mb-1">नया पासवर्ड *</label>
                  <input type="password" v-model="passwordChangeForm.new_password" required placeholder="कम से कम 8 अक्षर" class="w-full text-xs sm:text-sm p-2.5 rounded-xl border border-amber-300 focus:outline-none" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-sacred-900 mb-1">नए पासवर्ड की पुष्टि *</label>
                  <input type="password" v-model="passwordChangeForm.confirm_password" required class="w-full text-xs sm:text-sm p-2.5 rounded-xl border border-amber-300 focus:outline-none" />
                </div>
                <button type="submit" class="w-full py-3 rounded-xl sacred-gradient-bg text-white font-bold text-xs shadow hover:shadow-md transition">
                  पासवर्ड अपडेट करें (Save New Password)
                </button>
              </form>
            </div>

          </div>
        </div>

      </div>
    </main>

    <!-- ================================================================= -->
    <!-- MODALS & POPUPS                                                   -->
    <!-- ================================================================= -->

    <!-- MODAL 1: POOJA VARIATIONS POPUP (For Devotees) -->
    <div v-if="showVariationModal && selectedPoojaForVariations" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
      <div class="glass-card max-w-lg w-full rounded-3xl p-6 border border-amber-200 shadow-2xl max-h-[90vh] overflow-y-auto animate-fadeIn">
        <div class="flex items-center justify-between pb-3 border-b border-amber-100 mb-4">
          <h3 class="text-xl font-bold font-divine text-sacred-900">
            {{ currentLang === 'hi' ? selectedPoojaForVariations.name_hi : selectedPoojaForVariations.name_en }}
          </h3>
          <button @click="showVariationModal = false" class="text-stone-400 hover:text-stone-700 text-xl font-bold">✕</button>
        </div>

        <p class="text-xs text-stone-600 mb-4 leading-relaxed">
          {{ currentLang === 'hi' ? selectedPoojaForVariations.description_hi : selectedPoojaForVariations.description_en }}
        </p>

        <div class="space-y-3 mb-6">
          <div v-for="v in selectedPoojaForVariations.variations" :key="v.id" 
               @click="selectPackageAndScroll(v)"
               class="p-4 rounded-2xl border-2 border-amber-200 hover:border-sacred-600 bg-white/90 hover:bg-amber-50/80 cursor-pointer transition flex items-center justify-between shadow-xs">
            <div>
              <div class="font-bold text-sm text-sacred-900">{{ currentLang === 'hi' ? v.title_hi : v.title_en }}</div>
              <div class="text-xs text-stone-500 mt-0.5">{{ currentLang === 'hi' ? v.description_hi : v.description_en }}</div>
            </div>
            <div class="text-right">
              <div class="text-lg font-extrabold text-sacred-700">₹{{ v.price }}</div>
              <span class="text-2xs font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded">चुनें →</span>
            </div>
          </div>
        </div>

        <button @click="showVariationModal = false" class="w-full py-2.5 rounded-xl bg-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-300 transition">
          {{ t.close }}
        </button>
      </div>
    </div>

    <!-- MODAL 2: BLOG ARTICLE FULL DETAILS -->
    <div v-if="showBlogModal && selectedBlog" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
      <div class="glass-card max-w-2xl w-full rounded-3xl p-6 border border-amber-200 shadow-2xl max-h-[90vh] overflow-y-auto animate-fadeIn">
        <div class="flex items-center justify-between pb-3 border-b border-amber-100 mb-4">
          <span class="text-xs font-bold text-sacred-700">📖 आध्यात्मिक दर्शन व पंचांग</span>
          <button @click="showBlogModal = false" class="text-stone-400 hover:text-stone-700 text-xl font-bold">✕</button>
        </div>

        <img :src="selectedBlog.image_url" class="w-full h-56 rounded-2xl object-cover mb-4" onerror="this.src='https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80'" />
        <h3 class="text-xl md:text-2xl font-bold font-divine text-sacred-900 mb-3">
          {{ currentLang === 'hi' ? selectedBlog.title_hi : selectedBlog.title_en }}
        </h3>
        <p class="text-xs sm:text-sm text-stone-700 leading-relaxed whitespace-pre-line mb-6">
          {{ currentLang === 'hi' ? selectedBlog.content_hi : selectedBlog.content_en }}
        </p>

        <button @click="showBlogModal = false" class="w-full py-3 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
          {{ t.close }}
        </button>
      </div>
    </div>

    <!-- MODAL 3: PANDIT EDIT/ADD (With Photo Upload < 2MB & Rating) -->
    <div v-if="showPanditModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
      <div class="glass-card max-w-lg w-full rounded-3xl p-6 border border-amber-200 shadow-2xl max-h-[90vh] overflow-y-auto animate-fadeIn">
        <div class="flex items-center justify-between pb-3 border-b border-amber-100 mb-4">
          <h3 class="text-lg font-bold font-divine text-sacred-900">
            {{ editingPandit.id ? 'पुरोहित प्रोफ़ाइल संपादित करें' : 'नया पुरोहित जोड़ें' }}
          </h3>
          <button @click="showPanditModal = false" class="text-stone-400 hover:text-stone-700 text-xl font-bold">✕</button>
        </div>

        <form @submit.prevent="savePanditProfile" class="space-y-4">
          
          <!-- Photo Upload & Preview -->
          <div class="p-4 bg-amber-50/80 rounded-2xl border border-amber-200">
            <label class="block text-xs font-bold text-sacred-900 mb-2">पुरोहित फोटो (< 2MB)</label>
            <div class="flex items-center gap-4">
              <img :src="editingPandit.image_url || 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=500&auto=format&fit=crop&q=80'" 
                   class="w-16 h-16 rounded-full object-cover border-2 border-sacred-600 shadow" />
              <div class="flex-1">
                <input type="file" @change="uploadPanditPhoto($event)" accept="image/jpeg,image/png,image/webp" class="text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-sacred-700 file:text-white hover:file:bg-sacred-800 cursor-pointer" />
                <div class="text-2xs text-stone-500 mt-1">JPG, PNG, WEBP (अधिकतम 2MB)</div>
              </div>
            </div>
            <input type="text" v-model="editingPandit.image_url" placeholder="छवि यूआरएल (Image URL)" class="w-full text-xs p-2 rounded-lg border border-amber-300 mt-2 bg-white" />
          </div>

          <!-- Names -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">नाम (हिंदी) *</label>
              <input type="text" v-model="editingPandit.name_hi" required placeholder="पंडित..." class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">Name (English)</label>
              <input type="text" v-model="editingPandit.name_en" placeholder="Pandit..." class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
          </div>

          <!-- Titles -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">पदवी / उपाधि (हिंदी)</label>
              <input type="text" v-model="editingPandit.title_hi" placeholder="तीर्थ पुरोहित" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">Title (English)</label>
              <input type="text" v-model="editingPandit.title_en" placeholder="Tirth Purohit" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
          </div>

          <!-- Specialization -->
          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">विशेषज्ञता (Specialization)</label>
            <input type="text" v-model="editingPandit.specialization_hi" placeholder="रुद्राभिषेक, महामृत्युंजय जाप" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
          </div>

          <!-- Rating & Experience -->
          <div class="grid grid-cols-3 gap-3">
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">अनुभव (वर्ष)</label>
              <input type="number" v-model="editingPandit.experience_years" min="1" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">रेटिंग (1.0 - 5.0)</label>
              <input type="number" step="0.1" min="1" max="5" v-model="editingPandit.rating" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">रिव्यू संख्या</label>
              <input type="number" v-model="editingPandit.reviews_count" min="0" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
          </div>

          <!-- Contact Details -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">फोन नंबर</label>
              <input type="tel" v-model="editingPandit.phone" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">व्हाट्सएप नंबर</label>
              <input type="tel" v-model="editingPandit.whatsapp_number" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
          </div>

          <!-- Order & Status -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">{{ t.order_sort }}</label>
              <input type="number" v-model="editingPandit.display_order" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">स्थिति (Status)</label>
              <select v-model="editingPandit.is_active" class="w-full text-xs p-2.5 rounded-xl border border-amber-300 bg-white">
                <option :value="1">सक्रिय (Active)</option>
                <option :value="0">निष्क्रिय (Inactive)</option>
              </select>
            </div>
          </div>

          <div class="pt-2 flex gap-2">
            <button type="button" @click="showPanditModal = false" class="flex-1 py-3 rounded-xl bg-stone-200 text-stone-700 font-bold text-xs">
              रद्द करें
            </button>
            <button type="submit" class="flex-1 py-3 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.save_changes }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 4: POOJA EDIT/ADD (With Packages & Image Upload < 2MB) -->
    <div v-if="showPoojaModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
      <div class="glass-card max-w-xl w-full rounded-3xl p-6 border border-amber-200 shadow-2xl max-h-[90vh] overflow-y-auto animate-fadeIn">
        <div class="flex items-center justify-between pb-3 border-b border-amber-100 mb-4">
          <h3 class="text-lg font-bold font-divine text-sacred-900">
            {{ editingPooja.id ? 'पूजा सेवा संपादित करें' : 'नई पूजा सेवा जोड़ें' }}
          </h3>
          <button @click="showPoojaModal = false" class="text-stone-400 hover:text-stone-700 text-xl font-bold">✕</button>
        </div>

        <form @submit.prevent="savePoojaProfile" class="space-y-4">
          
          <!-- Image Upload -->
          <div class="p-4 bg-amber-50/80 rounded-2xl border border-amber-200">
            <label class="block text-xs font-bold text-sacred-900 mb-2">पूजा मुख्य चित्र (< 2MB)</label>
            <div class="flex items-center gap-4">
              <img :src="editingPooja.image_url || 'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80'" 
                   class="w-20 h-16 rounded-lg object-cover border border-sacred-600 shadow" />
              <div class="flex-1">
                <input type="file" @change="uploadPoojaPhoto($event)" accept="image/jpeg,image/png,image/webp" class="text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-sacred-700 file:text-white hover:file:bg-sacred-800 cursor-pointer" />
                <div class="text-2xs text-stone-500 mt-1">JPG, PNG, WEBP (अधिकतम 2MB)</div>
              </div>
            </div>
            <input type="text" v-model="editingPooja.image_url" placeholder="छवि यूआरएल" class="w-full text-xs p-2 rounded-lg border border-amber-300 mt-2 bg-white" />
          </div>

          <!-- Category & Order -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">पूजा श्रेणी (Category) *</label>
              <select v-model="editingPooja.category_id" required class="w-full text-xs p-2.5 rounded-xl border border-amber-300 bg-white">
                <option v-for="c in categories" :key="c.id" :value="c.id">
                  {{ c.name_hi }} ({{ c.name_en }})
                </option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">स्थिति (Status)</label>
              <select v-model="editingPooja.is_active" class="w-full text-xs p-2.5 rounded-xl border border-amber-300 bg-white">
                <option :value="1">सक्रिय (Active)</option>
                <option :value="0">निष्क्रिय (Inactive)</option>
              </select>
            </div>
          </div>

          <!-- Names -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">पूजा का नाम (हिंदी) *</label>
              <input type="text" v-model="editingPooja.name_hi" required placeholder="जैसे: सविधि रुद्राभिषेक" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
            <div>
              <label class="block text-xs font-bold text-sacred-900 mb-1">Pooja Name (English) *</label>
              <input type="text" v-model="editingPooja.name_en" required placeholder="e.g. Rudrabhishek" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
            </div>
          </div>

          <!-- Descriptions -->
          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">विवरण (हिंदी)</label>
            <textarea v-model="editingPooja.description_hi" rows="2" class="w-full text-xs p-2.5 rounded-xl border border-amber-300"></textarea>
          </div>

          <!-- DYNAMIC VARIATIONS / PACKAGES -->
          <div class="p-4 bg-amber-50/70 rounded-2xl border border-amber-200 space-y-3">
            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-sacred-900">📦 दक्षिणा एवं पैकेज (Variations)</span>
              <button type="button" @click="addVariationRow" class="text-2xs font-bold px-2.5 py-1 rounded bg-sacred-700 text-white">
                + पैकेज जोड़ें
              </button>
            </div>

            <div v-for="(v, index) in editingPooja.variations" :key="index" class="p-3 bg-white rounded-xl border border-amber-200 space-y-2">
              <div class="grid grid-cols-3 gap-2">
                <input type="text" v-model="v.title_hi" placeholder="पैकेज नाम (हिंदी)" class="text-xs p-1.5 rounded border border-amber-200" />
                <input type="text" v-model="v.title_en" placeholder="Package (English)" class="text-xs p-1.5 rounded border border-amber-200" />
                <div class="flex gap-1">
                  <input type="number" v-model="v.price" placeholder="₹ दक्षिणा" class="text-xs p-1.5 rounded border border-amber-200 w-full" />
                  <button type="button" @click="removeVariationRow(index)" class="text-red-500 hover:text-red-700 px-1 font-bold">✕</button>
                </div>
              </div>
              <input type="text" v-model="v.description_hi" placeholder="पैकेज विवरण (जैसे: 2 शास्त्री जी द्वारा)" class="w-full text-xs p-1.5 rounded border border-amber-200" />
            </div>
          </div>

          <div class="pt-2 flex gap-2">
            <button type="button" @click="showPoojaModal = false" class="flex-1 py-3 rounded-xl bg-stone-200 text-stone-700 font-bold text-xs">
              रद्द करें
            </button>
            <button type="submit" class="flex-1 py-3 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.save_changes }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 5: BLOG EDIT/ADD (With Photo Upload < 2MB) -->
    <div v-if="showBlogEditModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
      <div class="glass-card max-w-lg w-full rounded-3xl p-6 border border-amber-200 shadow-2xl max-h-[90vh] overflow-y-auto animate-fadeIn">
        <div class="flex items-center justify-between pb-3 border-b border-amber-100 mb-4">
          <h3 class="text-lg font-bold font-divine text-sacred-900">
            {{ editingBlog.id ? 'लेख संपादित करें' : 'नया लेख प्रकाशित करें' }}
          </h3>
          <button @click="showBlogEditModal = false" class="text-stone-400 hover:text-stone-700 text-xl font-bold">✕</button>
        </div>

        <form @submit.prevent="saveBlogArticle" class="space-y-4">
          <!-- Image -->
          <div class="p-4 bg-amber-50/80 rounded-2xl border border-amber-200">
            <label class="block text-xs font-bold text-sacred-900 mb-2">मुख्य चित्र (< 2MB)</label>
            <div class="flex items-center gap-4">
              <img :src="editingBlog.image_url || 'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?w=800&auto=format&fit=crop&q=80'" 
                   class="w-20 h-16 rounded-lg object-cover border border-sacred-600 shadow" />
              <div class="flex-1">
                <input type="file" @change="uploadBlogPhoto($event)" accept="image/jpeg,image/png,image/webp" class="text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-sacred-700 file:text-white hover:file:bg-sacred-800 cursor-pointer" />
                <div class="text-2xs text-stone-500 mt-1">JPG, PNG, WEBP (अधिकतम 2MB)</div>
              </div>
            </div>
            <input type="text" v-model="editingBlog.image_url" placeholder="छवि यूआरएल" class="w-full text-xs p-2 rounded-lg border border-amber-300 mt-2 bg-white" />
          </div>

          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">शीर्षक (हिंदी) *</label>
            <input type="text" v-model="editingBlog.title_hi" required class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
          </div>

          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">लेख सामग्री (हिंदी) *</label>
            <textarea v-model="editingBlog.content_hi" rows="5" required class="w-full text-xs p-2.5 rounded-xl border border-amber-300"></textarea>
          </div>

          <div class="pt-2 flex gap-2">
            <button type="button" @click="showBlogEditModal = false" class="flex-1 py-3 rounded-xl bg-stone-200 text-stone-700 font-bold text-xs">
              रद्द करें
            </button>
            <button type="submit" class="flex-1 py-3 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.save_changes }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 6: CATEGORY EDIT/ADD -->
    <div v-if="showCategoryModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
      <div class="glass-card max-w-md w-full rounded-3xl p-6 border border-amber-200 shadow-2xl animate-fadeIn">
        <div class="flex items-center justify-between pb-3 border-b border-amber-100 mb-4">
          <h3 class="text-lg font-bold font-divine text-sacred-900">
            {{ editingCategory.id ? 'श्रेणी संपादित करें' : 'नई श्रेणी जोड़ें' }}
          </h3>
          <button @click="showCategoryModal = false" class="text-stone-400 hover:text-stone-700 text-xl font-bold">✕</button>
        </div>

        <form @submit.prevent="saveCategory" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">श्रेणी का नाम (हिंदी) *</label>
            <input type="text" v-model="editingCategory.name_hi" required class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
          </div>
          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">Category Name (English) *</label>
            <input type="text" v-model="editingCategory.name_en" required class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
          </div>
          <div>
            <label class="block text-xs font-bold text-sacred-900 mb-1">स्लग (Slug)</label>
            <input type="text" v-model="editingCategory.slug" placeholder="rudrabhishek-seva" class="w-full text-xs p-2.5 rounded-xl border border-amber-300" />
          </div>
          <div class="pt-2 flex gap-2">
            <button type="button" @click="showCategoryModal = false" class="flex-1 py-3 rounded-xl bg-stone-200 text-stone-700 font-bold text-xs">
              रद्द करें
            </button>
            <button type="submit" class="flex-1 py-3 rounded-xl saffron-gradient-bg text-white font-bold text-xs shadow">
              {{ t.save_changes }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- FOOTER -->
    <footer class="sacred-gradient-bg text-white py-12 border-t-4 border-amber-400 mt-auto">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
          
          <div class="md:col-span-2 space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-amber-400 text-sacred-950 flex items-center justify-center font-bold text-xl">ॐ</div>
              <h3 class="text-xl font-bold font-divine">{{ t.site_title }}</h3>
            </div>
            <p class="text-xs text-amber-100/90 leading-relaxed max-w-md">
              पवित्र ओंकारेश्वर ज्योतिर्लिंग तीर्थ पर शास्त्रोक्त वैदिक पूजा, रुद्राभिषेक, महामृत्युंजय जाप एवं कालसर्प दोष शांति का अधिकृत एवं प्रामाणिक सेवा केंद्र।
            </p>
          </div>

          <div>
            <h4 class="font-bold text-sm text-amber-300 mb-3">त्वरित नेविगेशन</h4>
            <ul class="space-y-2 text-xs text-amber-100">
              <li><a href="javascript:void(0)" @click="navigateTo('home')" class="hover:underline">🏠 {{ t.nav_home }}</a></li>
              <li><a href="javascript:void(0)" @click="navigateTo('poojas')" class="hover:underline">🔱 {{ t.nav_pooja }}</a></li>
              <li><a href="javascript:void(0)" @click="navigateTo('pandits')" class="hover:underline">🙏 {{ t.nav_pandits }}</a></li>
              <li><a href="javascript:void(0)" @click="navigateTo('blogs')" class="hover:underline">📖 {{ t.nav_blogs }}</a></li>
              <li><a href="javascript:void(0)" @click="navigateTo('admin')" class="hover:underline">🔒 {{ t.nav_admin }}</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-bold text-sm text-amber-300 mb-3">पंडित जी का पता</h4>
            <p class="text-xs text-amber-100 leading-relaxed mb-2">
              📍 {{ t.temple_location }}
            </p>
            <p class="text-xs text-amber-100">
              📞 <strong>फोन:</strong> {{ SITE_CONFIG.primary_phone }}
            </p>
          </div>

        </div>

        <div class="border-t border-amber-500/40 pt-6 text-center text-xs text-amber-200 flex flex-col sm:flex-row items-center justify-between gap-2">
          <div>© 2026 {{ t.site_title }} • {{ SITE_CONFIG.head_priest_hi }} | सर्वाधिकार सुरक्षित</div>
          <div class="font-semibold tracking-wider text-amber-300">॥ हर हर महादेव ॥ ॐ नमः शिवाय ॥</div>
        </div>
      </div>
    </footer>

    <!-- MOBILE BOTTOM FIXED BAR -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-amber-300 shadow-2xl py-2 px-3 flex items-center justify-around text-sacred-900">
      <button @click="navigateTo('home')" class="flex flex-col items-center text-2xs font-semibold" :class="currentView === 'home' ? 'text-sacred-600' : 'text-stone-600'">
        <span class="text-lg">🏠</span>
        <span>{{ t.nav_home }}</span>
      </button>
      <button @click="navigateTo('poojas')" class="flex flex-col items-center text-2xs font-semibold text-stone-600">
        <span class="text-lg">🔱</span>
        <span>{{ t.nav_pooja }}</span>
      </button>
      <button @click="navigateTo('pandits')" class="flex flex-col items-center text-2xs font-semibold text-stone-600">
        <span class="text-lg">🙏</span>
        <span>{{ t.nav_pandits }}</span>
      </button>
      <a :href="'https://wa.me/' + SITE_CONFIG.whatsapp_number" target="_blank" class="flex flex-col items-center text-2xs font-semibold text-emerald-700">
        <span class="text-lg">💬</span>
        <span>WhatsApp</span>
      </a>
      <button @click="navigateTo('admin')" class="flex flex-col items-center text-2xs font-semibold" :class="currentView === 'admin' ? 'text-sacred-600' : 'text-stone-600'">
        <span class="text-lg">🔒</span>
        <span>Admin</span>
      </button>
    </div>

  </div>
  `
});

app.mount('#app');