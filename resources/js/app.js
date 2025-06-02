//引入 jQuery 库，让你可以使用 $()、.on()、.ajax() 等经典 jQuery 写法。
import $ from 'jquery';
//把 $ 和 jQuery 绑定到全局 window 对象
// 👉 这样你在 HTML <script> 或其他 JS 文件里都能直接用 $()，不用再 import $。
window.$ = window.jQuery = $;


import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
