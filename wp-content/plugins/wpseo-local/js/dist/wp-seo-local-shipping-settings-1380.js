!function(e){var t={};function o(l){if(t[l])return t[l].exports;var a=t[l]={i:l,l:!1,exports:{}};return e[l].call(a.exports,a,a.exports,o),a.l=!0,a.exports}o.m=e,o.c=t,o.d=function(e,t,l){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:l})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var l=Object.create(null);if(o.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)o.d(l,a,function(t){return e[t]}.bind(null,a));return l},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=83)}({83:function(e,t,o){"use strict";function l(){var e=jQuery(this).closest("tr"),t=e.data("id"),o=e.data("title"),l=e.data("defaults");e.remove(),jQuery("#location_setting_select").append('<option value="'+t+"\" data-defaults='"+JSON.stringify(l)+"'>"+decodeURI(o)+"</option>")}jQuery(document).ready((function(e){e("#location_setting_add").click((function(){var t=e("#location_setting_select").val();if(0!=t){var o=e("#location_setting_select option:selected").text(),a=e("#location_setting_select option:selected").data("defaults");e("#location_setting_select option:selected").remove();var c="";0==yoast_wcseo_local_translations.has_categories&&(c+=' checked="checked"'),e("tbody#shipping_locations").append('<tr class="location" data-id="'+t+'" data-title="'+encodeURI(o)+"\" data-defaults='"+JSON.stringify(a)+'\'  ><th scope="row" class="check-column"></th><td>'+o+'</td><td><label for="yoast_wcseo_local_pickup_location_allowed['+t+']" class="screen-reader-text">'+yoast_wcseo_local_translations.label_allow_location.replace("%s",o)+'</label><input type="checkbox"'+c+' name="yoast_wcseo_local_pickup_location_allowed['+t+']" /> <small>'+a.status+'</small></td><td><label for="yoast_wcseo_local_pickup_location_cost['+t+']" class="screen-reader-text">'+yoast_wcseo_local_translations.label_costs_location.replace("%s",o)+'</label><input type="text" name="yoast_wcseo_local_pickup_location_cost['+t+']" placeholder="'+yoast_wcseo_local_translations.placeholder_costs_location+'" class="input-text regular-input" > <small>'+a.price+'</small></td><td><input class="location_rule_remove" type="button" class="button" value="'+yoast_wcseo_local_translations.label_remove+'"></td></tr>'),e(".location_rule_remove").unbind("click"),e(".location_rule_remove").on("click",l)}})),e(".location_rule_remove").on("click",l),e("#woocommerce_yoast_wcseo_local_pickup_enabled").on("click",(function(t){e(this).is(":checked")&&(0==confirm(yoast_wcseo_local_translations.warning_enable_pickup)&&t.preventDefault())}))}))}});