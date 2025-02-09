import Vue from 'vue';
import Router from 'vue-router';
import Landing from './components/landing.vue';
import AboutUs from './components/AboutUs.vue';
import Gallery from './components/gallery.vue';
import Login from './components/login.vue';
import Signup from './components/signup.vue';
import Admin from './components/adminlog.vue';
import AccountE from './components/account.vue';
import Appointment from './components/appointment.vue';
import Laugoform from './components/laugoform.vue';
import Surform from './components/surform.vue';
import Surdash from './components/dash/surdash.vue';
import Dashappoint from './components/dash/appointment.vue';
import Dashdoctors from './components/dash/doctors.vue';
import Adddoctors from './components/dash/adddoctors.vue';
import Patientrecord from './components/dash/patientrecord.vue';
import Addpat from './components/dash/addpat.vue';
import Clinic from './components/dash/clinic.vue';
import Usermag from './components/dash/usermag.vue';
import EditUser from './components/dash/EditUser.vue';
import DoctorDetailsPage from './components/dash/doctors.vue';
import AppointmentForm from './components/surform.vue';

Vue.use(Router);

const routes = [
  { path: '/', component: Landing },
  { path: '/gallery', component: Gallery },
  { path: '/login', component: Login },
  { path: '/signup', component: Signup },
  { path: '/adminlog', component: Admin },
  { path: '/account', component: AccountE },
  { path: '/appointment', component: Appointment },
  { path: '/laugoform', component: Laugoform },
  { path: '/surform', component: Surform },
  { path: '/surdash', component: Surdash },
  { path: '/dashappoint', component: Dashappoint },
  { path: '/dashdoctors', component: Dashdoctors },
  { path: '/adddoctors', component: Adddoctors },
  { path: '/addpat', component: Addpat },
  { path: '/patientrecord', component: Patientrecord },
  { path: '/clinic', component: Clinic },
  { path: '/usermag', component: Usermag },
  { path: '/aboutus', component: AboutUs },
  {
    path: '/edit-user/:id',
    name: 'EditUser',
    component: EditUser,
    props: true,
  },
  {
    path: '/appointment/:clinicId',  // Clinic ID passed as a parameter
    component: AppointmentForm,
  },
  
  // {
  //   path: '/appointment/:id',
  //   name: 'AppointmentForm',
  //   component: Surform,
  //   props: (route) => ({
  //     clinic: {
  //       id: route.params.id,
  //       name: route.query.name, // Pass name in query params
  //     },
  //   }),
  // },
  {
    path: '/doctor/:id',
    name: 'DoctorDetails',
    component: DoctorDetailsPage, // Your component to show doctor details
  },
  
  
];

export default new Router({
  mode: 'history',
  routes,
});
