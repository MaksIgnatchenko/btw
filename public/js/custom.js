window.onload = function () {
    /* Custom Select */
    (function () {
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
            a.addEventListener("click", function (e) {
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
    (function () {
        var elemTitle, list, labelList;
        /* Element category title */
        elemTitle = document.getElementById('category-title');
        /* Category list element */
        list = document.getElementById('tell-categories');
        /* Label list element */
        labelList = document.querySelector('.tell-form-list');

        /* Open/close category list and toggle triangle after click in title  */
        function openCategoryList(e) {
            e.stopPropagation();
            var that = e.target;
            if (!that.classList.contains('tell-form-category__display--open')) {
                that.classList.add('tell-form-category__display--open');
                list.classList.remove('tell-form-category__list--close');
                return true;
            } else if (that.classList.contains('tell-form-category__display--open')) {
                closeCategoryList(e);
            }
        }

        function closeCategoryList(e) {
            var that = e.target;

            // don't close when click on categories
            if (e.target.classList.contains('tell-form-category__item')) {
                return false;
            }

            // close on click categories title
            if (e.target.classList.contains('tell-form-category__display--open')) {
                elemTitle.classList.remove('tell-form-category__display--open');
                list.classList.add('tell-form-category__list--close');
                return true;
            }

            // close categories list in any other cases
            if (elemTitle.classList.contains('tell-form-category__display--open')) {
                elemTitle.classList.remove('tell-form-category__display--open');
                list.classList.add('tell-form-category__list--close');
            }
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

            if (cs) {
                cs.querySelector('option[value="' + id + '"]')
                    .setAttribute('selected', 'selected');
            }
        }

        /* Get category name after click on list item */
        function chooseCategory(e) {
            var that = e.target;
            if (!that.classList.contains('tell-form-category__item--chosen')) {
                var text = that.textContent || that.innerText;
                that.classList.add('tell-form-category__item--chosen');
                createLabel(that.getAttribute('id'), text);
                closeCategoryList();
            }
        }

        var cs = document.querySelector('select[name^=categories]');

        if (cs) {
            cs.querySelectorAll('option[selected]').forEach(function (o) {
                createLabel(o.getAttribute('value'), o.innerHTML);
                document.querySelector('.tell-form-category__item[id="' + o.getAttribute('value') + '"]')
                    .classList.add('tell-form-category__item--chosen');
            });
        }


        /* Remove label and activate list item */
        function removeLabel(e) {
            if (e.target.tagName.toUpperCase() === 'I') {
                var label = e.target.parentElement.parentElement;
                var input = e.target.parentElement.nextElementSibling;
                var elemId = input.getAttribute('value');
                var categoryElem = document.getElementById(elemId);
                var items = document.querySelector('.tell-form-list');

                label.classList.add('tell-form-item--remove');
                var myTimeout = setTimeout(function () {
                    items.removeChild(label);
                    clearTimeout(myTimeout);
                }, 300);
                categoryElem.classList.remove('tell-form-category__item--chosen');
                document
                    .querySelector('select[name^=categories]')
                    .querySelector('option[value="' + elemId + '"]')
                    .removeAttribute('selected', 'selected');

            }
        }


        if (elemTitle) {
            elemTitle.addEventListener('click', openCategoryList);
            list.addEventListener('click', chooseCategory);
            labelList.addEventListener('click', removeLabel);
            document.addEventListener('click', closeCategoryList);
        }
    })();


    /* Set height to empty shop container */
    (function () {
        var shopWrapper = document.querySelector('.main-shop-wrapper'),
            shopContainer = document.querySelector('.main-shop-empty');

        function setHeight(wrapper, el) {
            var height = wrapper.offsetHeight - 60;
            el.style.height = height + 'px';
        }

        function onResize() {
            shopContainer.removeAttribute('style');
            setHeight(shopWrapper, shopContainer);
        }

        if (shopContainer) {
            setHeight(shopWrapper, shopContainer);
            if (window.innerWidth > 400) {
                window.addEventListener('resize', onResize);
            }
        }
    })();

};
