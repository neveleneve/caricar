import{B as c,s as a,l,S as i}from"./app-C-qkH5mP.js";const d=c("auth",{state:()=>({token:a.getItem(i.TOKEN)||null,user:a.getItem(i.AUTH)||null,loading:!1,error:null}),actions:{async login(e){var s,r;try{this.loading=!0,this.error=null;const t=await l.post("/api/login",e),{token:n,user:o}=t.data;return this.setAuth(n),this.user=o,a.setItem(i.AUTH,o),l.defaults.headers.common.Authorization=`Bearer ${n}`,t}catch(t){throw this.error=((r=(s=t.response)==null?void 0:s.data)==null?void 0:r.message)||"Login failed",t}finally{this.loading=!1}},async loginWithGoogle(e){var s,r,t,n;try{this.loading=!0,this.error=null;const o=await l.post("/api/login/google",e),{token:h,user:u}=o.data;return this.setAuth(h),this.user=u,a.setItem(i.AUTH,u),l.defaults.headers.common.Authorization=`Bearer ${h}`,o}catch(o){this.error=((r=(s=o.response)==null?void 0:s.data)==null?void 0:r.message)||"Google login failed";const h=((n=(t=o.response)==null?void 0:t.data)==null?void 0:n.error)||"Google login failed fasddfa";throw console.log(h),o}finally{this.loading=!1}},async loginWithFacebook(e){var s,r;try{this.loading=!0,this.error=null;const t=await l.post("/api/login/facebook",e),{token:n,user:o}=t.data;return this.setAuth(n),this.user=o,a.setItem(i.AUTH,o),l.defaults.headers.common.Authorization=`Bearer ${n}`,t}catch(t){throw this.error=((r=(s=t.response)==null?void 0:s.data)==null?void 0:r.message)||"Facebook login failed",t}finally{this.loading=!1}},setAuth(e){this.token=e,a.setItem(i.TOKEN,e)},clearAuth(){this.token=null,this.user=null,this.error=null,a.clear(),delete l.defaults.headers.common.Authorization},logout(){this.clearAuth()},async verifyToken(){try{return this.token?(await l.get("/api/auth/verify")).status===200:!1}catch{return this.clearAuth(),!1}}},getters:{isAuthenticated:e=>!!e.token}}),m=c("theme",{state:()=>{const e=window.matchMedia("(prefers-color-scheme: dark)").matches;let s;try{const r=a.getItem(i.THEME);s=r!==null?r:e}catch{s=e}return{isDark:s,isTransitioning:!1}},actions:{initTheme(){this.applyTheme(),a.getItem(i.THEME)===null&&a.setItem(i.THEME,this.isDark)},toggleTheme(){this.isTransitioning=!0,this.isDark=!this.isDark,a.setItem(i.THEME,this.isDark),this.applyTheme(),setTimeout(()=>{this.isTransitioning=!1},300)},applyTheme(){document.documentElement.classList.toggle("dark",this.isDark),document.body.classList.toggle("dark",this.isDark)}},persist:!0});export{m as a,d as u};
