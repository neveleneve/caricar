import{D as m}from"./Sidebar-BcOW22Pq.js";import{u as l}from"./theme-DUdhtcv_.js";import{_ as x,c as f,w as g,u as p,a as d,o as i,s as n,S as u,b as h,d as e}from"./app-C-qkH5mP.js";const S={__name:"Index",setup(_,{expose:s}){s();const r=p(),t=l(),c=d(()=>{const o=n.getItem(u.AUTH);return(o==null?void 0:o.role)||"User"});i(()=>{(!t.isAuthenticated||!n.getItem(u.AUTH))&&(t.clearAuth(),r.push("/login"))});const a={router:r,authStore:t,userRole:c,DashboardLayout:m,get useAuthStore(){return l},computed:d,onMounted:i,get useRouter(){return p},get storage(){return n},get STORAGE_KEYS(){return u}};return Object.defineProperty(a,"__isScriptSetup",{enumerable:!1,value:!0}),a}};function A(_,s,r,t,c,a){return h(),f(t.DashboardLayout,null,{default:g(()=>s[0]||(s[0]=[e("div",{class:"container mx-auto mb-4"},[e("header",{class:"page-header"},[e("div",{class:"flex items-center gap-3"},[e("h1",{class:"flex items-center py-1.5 text-xl font-semibold text-pastel-dark-700 dark:text-pastel-light-500"},[e("span",{class:"material-icons"},"people"),e("span",{class:"ml-1 text-pastel-dark-700 dark:text-pastel-light-500"}," User ")])])])],-1)])),_:1})}const I=x(S,[["render",A],["__file","C:/laragon/www/caricar/resources/js/components/admin/user/Index.vue"]]);export{I as default};
