
export const cookieMixin = {
    methods: {
      setCookie: function (name, value, expireDays){
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + expireDays);
        document.cookie = name + "=" + escape(value) + ((expireDays == null) ? "" : ";expires=" + exdate.toGMTString());
      },
      getCookie: function (name){
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg)) {
            return (arr[2]);
        }
        return null;
      },
      delCookie: function(name){ 
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = this.getCookie(name);
        if (cval != null)
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
        
      },
    }
  }