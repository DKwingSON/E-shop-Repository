function SetCookie (name, value)  //��������Ϊname,ֵΪvalue��Cookie
{var expdate = new Date();
expdate.setTime(expdate.getTime() + 30 * 60 * 1000);
document.cookie = name+"="+value+";expires="+expdate.toGMTString()+";path=/";
alert("�����Ʒ"+name+"�ɹ�!");
var cat=window.open("show_cat.php","cat","toolbar=no,menubar=no,location=no,status=no,width=420,height=280"); //��һ���´�������ʾͳ�Ƶ���Ʒ��Ϣ������ʾ�����Ƴ���} 
}
function Deletecookie (name) {  //ɾ������Ϊname��Cookie
var exp = new Date();  
    exp.setTime (exp.getTime() - 1);  
    var cval = GetCookie (name);  
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}
function Clearcookie()   //���COOKIE
    {
    var temp=document.cookie.split(";");
    var loop3;
    var ts;
    for (loop3=0;loop3<temp.length;loop3++)
        {
        ts=temp[loop3].split("=")[0];
        if (ts.indexOf('mycat')!=-1)
            DeleteCookie(ts);     //���ts����mycat����ִ�����
        } 
    }

function getCookieVal (offset) {       //ȡ��������Ϊoffset��cookieֵ
    var endstr = document.cookie.indexOf (";", offset);  
    if (endstr == -1)
        endstr = document.cookie.length;  
        return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) {  //ȡ������Ϊname��cookieֵ
        var arg = name + "=";  
        var alen = arg.length;  
        var clen = document.cookie.length;  
        var i = 0;  
        while (i < clen) {    
        var j = i + alen;    
        if (document.cookie.substring(i, j) == arg)      
                return getCookieVal (j);    
                i = document.cookie.indexOf(" ", i) + 1;    
                if (i == 0) break;   
        }  
        return null;
}
