var textArea = (function () {
    var obj;

    function init(id)
    {
        obj = document.querySelector(id);

        if (obj) {
            obj.addEventListener('keydown', autoSize);
            obj.addEventListener('keydown', insertTab);
        }
    }

    function autoSize()
    {
        var el = this;
        setTimeout(function(){
            el.style.cssText = 'height:auto;';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        }, 0);
    }

    function insertTab(e)
    {
        var keyCode = e.keyCode || e.which;
        if (keyCode == 9) {
            e.preventDefault();
            insertAtCaret('txt', '    ');
        }
    }

    function insertAtCaret(areaId, text)
    {
        var txtarea   = obj;
        var scrollPos = txtarea.scrollTop;
        var strPos    = 0;
        var br        = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? "ff" : (document.selection ? "ie" : false ));

        if (br == "ie") {
            txtarea.focus();
            var range = document.selection.createRange();
            range.moveStart('character', -txtarea.value.length);
            strPos = range.text.length;
        } else if (br == "ff") {
            strPos = txtarea.selectionStart;
        }

        var front = (txtarea.value).substring(0,strPos);
        var back = (txtarea.value).substring(strPos,txtarea.value.length);
        txtarea.value = front + text + back;
        strPos = strPos + text.length;
        if (br == "ie") {
            txtarea.focus();
            var range = document.selection.createRange();
            range.moveStart('character', -txtarea.value.length);
            range.moveStart('character', strPos);
            range.moveEnd('character', 0);
            range.select();
        } else if (br == "ff") {
            txtarea.selectionStart = strPos;
            txtarea.selectionEnd = strPos;
            txtarea.focus();
        }

        txtarea.scrollTop = scrollPos;
    }

    return {
        init: init
    }
})();

textArea.init('#response');

