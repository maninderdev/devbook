<script>
    function addDiv(parent_div, content, attrs) {
        var div = document.createElement('div');
        var parent = document.getElementById(parent_div);

        for (var key in attrs) {
            if (attrs.hasOwnProperty(key)) {
                div.setAttribute(key, attrs[key]);
            }
        }
        div.innerHTML = content;
        if (parent) {
            parent.appendChild(div);
        }
    }

    var button = document.getElementsByTagName('button')[0];
    if (button) {
        button.addEventListener('click', function() {
            // change dynamically your new div
            addDiv('parent', 'hi', {
                'class': 'someclass someclass',
                'data-attr': 'attr'
            });
        });
    }
</script>
<button>Add Div</button>
<div id="parent">

</div>