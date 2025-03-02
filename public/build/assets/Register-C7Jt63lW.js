import{u as w,a as S}from"./theme-DUdhtcv_.js";import{_ as A,i as D,e as n,d as e,q as k,A as P,n as s,t as x,w as h,T as j,x as N,p as g,v as m,g as T,h as v,u as C,j as o,o as R,b as d}from"./app-C-qkH5mP.js";const q={__name:"Register",setup(V,{expose:a}){a();const p=C(),t=w(),u=S(),f=o(""),l=o(""),r=o(""),b=o(""),i=o(null),c=o(!1);R(()=>{u.initTheme()});const y={router:p,authStore:t,themeStore:u,name:f,email:l,password:r,password_confirmation:b,error:i,loading:c,toggleTheme:()=>{u.toggleTheme()},handleRegister:async()=>{if(i.value=null,c.value=!0,r.value!==b.value){i.value="Passwords do not match",c.value=!1;return}try{await t.register({name:f.value,email:l.value,password:r.value,password_confirmation:b.value}),p.push("/administrator/dashboard")}catch(_){_.response?i.value=_.response.data.message||"Registration failed":i.value="Unable to connect to server"}finally{c.value=!1}},get useAuthStore(){return w},get useThemeStore(){return S},onMounted:R,ref:o,get useRouter(){return C}};return Object.defineProperty(y,"__isScriptSetup",{enumerable:!1,value:!0}),y}},L={class:"flex min-h-screen transition-colors duration-200 bg-gradient-to-br from-blue-50 to-gray-100 dark:from-gray-900 dark:to-gray-800"},U=["disabled"],z={class:"flex items-center justify-center w-full p-6 lg:w-1/2 bg-pastel-light-500 dark:bg-pastel-dark-700"},B={class:"w-full max-w-md space-y-8"},M={class:"flex flex-col items-center mb-10 lg:hidden"},E={key:0,src:"/assets/logo/caricar-dark.png",class:"h-9",alt:"Logo Caricar.id Dark"},F={key:1,src:"/assets/logo/caricar-light.png",class:"h-9",alt:"Logo Caricar.id Light"},O={class:"p-8 transition-colors duration-200 shadow-2xl bg-pastel-light-400 rounded-xl dark:bg-pastel-dark-600"},Y={key:0,class:"flex items-center p-4 mb-6 text-sm border rounded-lg text-pastel-red-600 border-pastel-red-600 bg-pastel-red-100"},G={class:"relative"},H={class:"relative"},I={class:"relative"},J={class:"relative"},K=["disabled"],Q={class:"flex items-center justify-center font-bold"},W={key:0,class:"mr-2 material-icons animate-spin"},X={class:"mt-4 text-center"};function Z(V,a,p,t,u,f){const l=D("router-link");return d(),n("div",L,[e("button",{onClick:t.toggleTheme,disabled:t.themeStore.isTransitioning,class:s(["absolute p-2 rounded-lg text-pastel-dark-600 bg-pastel-light-500 dark:bg-pastel-dark-700 top-4 right-4 dark:text-pastel-light-500 hover:bg-pastel-light-700 dark:hover:bg-pastel-dark-600",{"opacity-50 cursor-wait":t.themeStore.isTransitioning}])},[e("span",{class:s(["material-icons theme-icon",[t.themeStore.isDark?"dark-to-light":"light-to-dark",{"animate-theme":t.themeStore.isTransitioning}]])},x(t.themeStore.isDark?"light_mode":"dark_mode"),3)],10,U),k(l,{to:"/",class:"absolute p-2 rounded-lg text-pastel-dark-600 bg-pastel-light-500 dark:bg-pastel-dark-700 top-4 right-16 dark:text-pastel-light-500 hover:bg-pastel-light-700 dark:hover:bg-pastel-dark-600"},{default:h(()=>a[4]||(a[4]=[e("span",{class:"material-icons"}," home ",-1)])),_:1}),a[12]||(a[12]=P('<div class="hidden w-1/2 transition-colors duration-200 bg-pastel-blue-600 dark:bg-pastel-blue-800 lg:flex lg:flex-col lg:justify-center lg:items-center"><div class="px-12 text-center"><div class="flex flex-col items-center"><img src="/assets/logo/caricar-dark.png" class="h-20 mb-1" alt="Logo Politeam Dark"></div><p class="text-xl text-blue-100">Your reliable payment system, simplified.</p></div></div>',1)),e("div",z,[e("div",B,[e("div",M,[t.themeStore.isDark?(d(),n("img",E)):(d(),n("img",F))]),e("div",O,[a[11]||(a[11]=e("div",{class:"mb-8 text-center"},[e("h2",{class:"text-2xl font-bold text-pastel-dark-700 dark:text-pastel-light-500"},"Create Account "),e("p",{class:"mt-2 text-pastel-dark-700 dark:text-pastel-light-500"},"Please fill in your details")],-1)),k(j,{name:"fade"},{default:h(()=>[t.error?(d(),n("div",Y,[a[5]||(a[5]=e("span",{class:"mr-2 text-pastel-red-600 material-icons"},"error",-1)),v(" "+x(t.error),1)])):T("v-if",!0)]),_:1}),e("form",{onSubmit:N(t.handleRegister,["prevent"]),class:"space-y-6"},[e("div",null,[a[6]||(a[6]=e("label",{for:"name",class:"block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500"}," Full Name ",-1)),e("div",G,[g(e("input",{"onUpdate:modelValue":a[0]||(a[0]=r=>t.name=r),id:"name",type:"text",required:"",class:s(["w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent",{"opacity-50":t.loading}]),autocomplete:"off"},null,2),[[m,t.name]])])]),e("div",null,[a[7]||(a[7]=e("label",{for:"email",class:"block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500"}," Email Address ",-1)),e("div",H,[g(e("input",{"onUpdate:modelValue":a[1]||(a[1]=r=>t.email=r),id:"email",type:"email",required:"",class:s(["w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent",{"opacity-50":t.loading}]),autocapitalize:"off",autocorrect:"off",autocomplete:"off"},null,2),[[m,t.email]])])]),e("div",null,[a[8]||(a[8]=e("label",{for:"password",class:"block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500"}," Password ",-1)),e("div",I,[g(e("input",{"onUpdate:modelValue":a[2]||(a[2]=r=>t.password=r),id:"password",type:"password",required:"",autocomplete:"off",autocapitalize:"off",autocorrect:"off",class:s([{"opacity-50":t.loading},"w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent"])},null,2),[[m,t.password]])])]),e("div",null,[a[9]||(a[9]=e("label",{for:"password_confirmation",class:"block mb-1 text-sm font-medium text-pastel-dark-700 dark:text-pastel-light-500"}," Confirm Password ",-1)),e("div",J,[g(e("input",{"onUpdate:modelValue":a[3]||(a[3]=r=>t.password_confirmation=r),id:"password_confirmation",type:"password",required:"",autocomplete:"off",autocapitalize:"off",autocorrect:"off",class:s([{"opacity-50":t.loading},"w-full px-4 py-3 transition duration-150 ease-in-out border border-gray-300 rounded-lg dark:bg-pastel-dark-500 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent"])},null,2),[[m,t.password_confirmation]])])]),e("button",{type:"submit",disabled:t.loading,class:s(["w-full py-3 transform rounded-lg text-pastel-light-500 bg-pastel-blue-500 hover:bg-pastel-blue-400 focus:outline-none focus:ring-2 focus:ring-pastel-blue-400 focus:ring-offset-2",{"opacity-75 cursor-not-allowed":t.loading}])},[e("div",Q,[t.loading?(d(),n("span",W," sync ")):T("v-if",!0),v(" "+x(t.loading?"Creating Account...":"Create Account"),1)])],10,K),e("div",X,[k(l,{to:"/login",class:"text-sm text-pastel-blue-500 hover:text-pastel-blue-400 dark:text-pastel-blue-400 dark:hover:text-pastel-blue-300"},{default:h(()=>a[10]||(a[10]=[v(" Sudah Punya Akun? Login disini ")])),_:1})])],32)])])])])}const re=A(q,[["render",Z],["__file","C:/laragon/www/caricar/resources/js/components/Register.vue"]]);export{re as default};
