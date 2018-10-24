window.onload = function() {
    /* Custom Select */
    (function(){
        var x, i, j, selElmnt, a, b, c, e;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        for (i = 0; i < x.length; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            e = x[i].insertBefore(a, selElmnt.nextSibling);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < selElmnt.length; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function (e) {
                    divSelectClickEvent.call(this, e);
                });
                b.appendChild(c);
            }
            x[i].insertBefore(b, e.nextSibling);
            a.addEventListener("click", function(e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }
        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            for (i = 0; i < y.length; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < x.length; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
    })();

    /* Add categories */
    (function(){
        var elemTitle, list, labelList;
        /* Element category title */
        elemTitle = document.getElementById('category-title');
        /* Category list element */
        list = document.getElementById('tell-categories');
        /* Label list element */
        labelList = document.querySelector('.tell-form-list');

        /* Open/close category list and toggle triangle after click in title  */
        function openCategoryList(e) {
            var that = e.target;
            if( !that.classList.contains('tell-form-category__display--open') ) {
                that.classList.add('tell-form-category__display--open');
                list.classList.remove('tell-form-category__list--close')
            } else {
                that.classList.remove('tell-form-category__display--open');
                list.classList.add('tell-form-category__list--close');
            }
        }

        function closeCategoryList() {
            elemTitle.classList.remove('tell-form-category__display--open');
            list.classList.add('tell-form-category__list--close');
        }

        /* Generate markdown for category label */
        function createLabel(id, name) {

            /* Create elements */
            var li = document.createElement('LI');
            var span = document.createElement('SPAN');
            var icon = document.createElement('I');
            var text = document.createTextNode(name);
            var input = document.createElement('INPUT');

            /* To combine elements */
            span.appendChild(icon);
            span.appendChild(text);
            input.setAttribute('type', 'text');
            input.setAttribute('value', id);
            input.setAttribute('hidden', 'hidden');
            li.classList.add('tell-form-item');
            li.appendChild(span);
            li.appendChild(input);

            /* Add created element in list */
            labelList.appendChild(li);

            var cs = document.querySelector('select[name^=categories]');

            if(cs) {
                cs.querySelector('option[value="' + id + '"]')
                    .setAttribute('selected', 'selected');
            }
        }

        /* Get category name after click on list item */
        function chooseCategory(e) {
            var that = e.target;
            if( !that.classList.contains('tell-form-category__item--chosen') ) {
                var text = that.textContent || that.innerText;
                that.classList.add('tell-form-category__item--chosen');
                createLabel(that.getAttribute('id'), text);
                closeCategoryList();
            }
        }

        var cs = document.querySelector('select[name^=categories]');

        if(cs) {
            cs.querySelectorAll('option[selected]').forEach(function (o) {
                createLabel(o.getAttribute('value'), o.innerHTML);
                document.querySelector('.tell-form-category__item[id="'+o.getAttribute('value')+'"]')
                    .classList.add('tell-form-category__item--chosen');
            });
        }


        /* Remove label and activate list item */
        function removeLabel(e) {
            if( e.target.tagName.toUpperCase() === 'I' ) {
                var label = e.target.parentElement.parentElement;
                var input = e.target.parentElement.nextElementSibling;
                var elemId = input.getAttribute('value');
                var categoryElem = document.getElementById(elemId);
                var items = document.querySelector('.tell-form-list');

                label.classList.add('tell-form-item--remove');
                setTimeout(function(){
                    items.removeChild(label);
                },300);
                categoryElem.classList.remove('tell-form-category__item--chosen');
                document
                    .querySelector('select[name^=categories]')
                    .querySelector('option[value="'+elemId+'"]')
                    .removeAttribute('selected', 'selected');

            }
        }


        if( elemTitle ) {
            elemTitle.addEventListener('click', openCategoryList);
            list.addEventListener('click', chooseCategory);
            labelList.addEventListener('click', removeLabel);
        }
    })();
};

function divSelectClickEvent(e) {
    /*when an item is clicked, update the original select box,
    and the selected item:*/
    var y, i, k, s, h, ki;
    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
    h = this.parentNode.previousSibling;
    for (i = 0; i < s.length; i++) {
        if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
                y[k].removeAttribute("class");
            }
            /* pass through select and remove attribute selected */
            for ( ki = 0; ki < s.options.length; ki++ ) {
                if( s.options[ki].hasAttribute('selected') ) {
                    s.options[ki].removeAttribute('selected');
                }
            }
            s.options[i].setAttribute("selected", "selected");
            this.setAttribute("class", "same-as-selected");
            var event = new Event("change");
            s.dispatchEvent(event);
            break;
        }
    }
    h.click();
}