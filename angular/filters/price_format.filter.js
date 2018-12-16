export function PriceFormat () {
    return function (price) {
        if(price==undefined){
            return "";
        }
        else{
            price += "";
            var tab = price.split('');
            var p = "";
            for (i = tab.length; i > 0; i--) {
                if (i % 3 == 0) {
                    p += " ";
                }
                p += tab[tab.length - i];
            }
            return p;
        }
    }
}
