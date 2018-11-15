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
                closeCategoryList(e);
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

    /* Add images to input type file */
    (function () {
        var inputs = document.querySelectorAll('.form-item__inp-file'),
            blocks = document.querySelectorAll('.form-item__block');

        // Check image size
        function validateFileSize(size) {
            // 20971520 -> 20 Mb
            if (size > 20971520) {
                return true;
            }
            return false;
        }

        // Clear input
        function clearInput(element) {
            element.value = "";
            element.removeAttribute('disabled');
        }

        // Clear background-image
        function clearBgImage(element) {
            element.removeAttribute('style');
        }

        // Generate error message
        function showErrorMessage(block) {
            var p = document.createElement('P');
            p.classList.add('form-item__block__error');
            p.innerHTML = "Too large image";
            block.appendChild(p);
        }

        // Object use for bind clearBlock function.
        var eventToBlock = {};

        // Clear block and open write input
        function clearBlock(element, inpt) {
            clearBgImage(element);
            element.firstElementChild.classList.remove('form-item__label--remove');
            setTimeout(function () {
                clearInput(inpt);
                element.removeEventListener('click', eventToBlock, false);
            }, 200);
        }

        function addFile(index) {
            var block = blocks[index],
                element = inputs[index],
                file = element.files[0];
            if (validateFileSize(file.size)) {
                clearInput(element);
                if (block.lastElementChild.nodeName.toUpperCase() !== 'P') {
                    showErrorMessage(block);
                }
            } else {
                if (block.lastElementChild.nodeName.toUpperCase() === 'P') {
                    block.removeChild(block.lastElementChild);
                }
                element.setAttribute('disabled', true);
                block.style.backgroundImage = 'url(' + window.URL.createObjectURL(file) + ')';
                block.firstElementChild.classList.add('form-item__label--remove');
                eventToBlock = clearBlock.bind(null, block, element);
                block.addEventListener('click', eventToBlock, false);
            }
        }

        /* Clear disable attribute on input type file before send form */
        function clearDisabledAttr(event, elements) {
            event.preventDefault();
            for (var i = 0; i < elements.length; i++) {
                elements[i].removeAttribute('disabled');
            }
            event.target.submit();
        }

        /* Add listener to inputs */
        if (inputs.length) {
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('change', addFile.bind(null, i));
            }
            var form;
            if(form = document.querySelector('form[name="add-new-product"]')) {
                form.addEventListener('submit', function (event) {
                    clearDisabledAttr(event, inputs);
                });
            }
            if(form = document.querySelector('form[name="edit-product"]')) {
                form.addEventListener('submit', function (event) {
                    clearDisabledAttr(event, inputs);
                });
            }
        }
    })();

    /* Prohibit the input of all characters except numeric */
    (function () {
        var addQuantity = document.querySelector('input[name="add-new-quantity"]');

        function checkInputValue(event) {
            var filteredValue = event.target.value.replace(/\D/g, '');
            event.target.value = filteredValue;
        }

        if (addQuantity) {
            addQuantity.addEventListener('input', checkInputValue);
        }
    })();

    /* Tabs */
    (function () {
        var tabsWrapper = document.querySelector('.tabs-wrapper');

        function initTabs() {
            var headerBlock = tabsWrapper.querySelector('.tabs-header'),
                bodyBlock = tabsWrapper.querySelector('.tabs-body'),
                headerItems = headerBlock.querySelectorAll('.tabs-item'),
                bodyItems = bodyBlock.querySelectorAll('.tabs-item');

            function changeVisibleTab(event) {
                event.preventDefault();
                var index = null;

                // find index of current element
                for (var i = 0; i < headerItems.length; i++) {
                    if (headerItems[i] === event.currentTarget) {
                        index = i;
                        break;
                    }
                }

                changeTab(headerItems, bodyItems, index);
            }

            /* After init add active class to first head link and add click listener to all links */
            function addEvent(items) {
                for (var i = 0; i < items.length; i++) {
                    items[i].addEventListener('click', changeVisibleTab);
                }
            }

            /* Add hidden class to all list item and remove to current item */
            function changeTab(listHeader, listBody, index) {
                var count = listHeader.length;

                for (var i = 0; i < count; i++) {
                    listBody[i].classList.add('tabs-item--hide');
                    listHeader[i].classList.remove('tabs-item--active');
                }
                listBody[index].classList.remove('tabs-item--hide');
                listHeader[index].classList.add('tabs-item--active');
            }

            addEvent(headerItems);
            changeTab(headerItems, bodyItems, 0);
        }

        if (tabsWrapper) {
            initTabs(tabsWrapper);
        }
    })();

    /* Сheck for new password identity */
    (function () {
        var newPass = document.getElementById('new-pass'),
            confirmPass = document.getElementById('new-pass-confirm');

        function createMessage(el) {
            var p = document.createElement('P');
            p.classList.add('alert', 'alert-danger');
            p.innerHTML = "Passwords do not match";
            el.appendChild(p);
        }

        function checkIdentity(event) {
            var checkedValue = '',
                referenceValue = '';

            if (event.target === confirmPass) {
                checkedValue = event.target.value;
                referenceValue = newPass.value;

                if (checkedValue !== referenceValue) {
                    if (!event.target.classList.contains('form-item__inp--error')) {
                        event.target.classList.add('form-item__inp--error');
                        createMessage(event.target.parentElement);
                    }

                } else {
                    if (event.target.classList.contains('form-item__inp--error')) {
                        event.target.classList.remove('form-item__inp--error');
                        event.target.parentElement.removeChild(event.target.nextElementSibling);
                    }
                }
            }
        }

        if (newPass) {
            newPass.addEventListener('blur', checkIdentity);
            confirmPass.addEventListener('blur', checkIdentity);
        }
    })();

    /* Change photo on Settings page */
    (function () {
        var fileEl = document.getElementById('edit-photo'),
            label = document.querySelector('.edit-photo-btn');

        function clearInput() {
            fileEl.previousElementSibling.innerHTML = "Add photo";
            fileEl.value = '';
            document.querySelector('.form-container-decor-abs').style.backgroundImage = '';
            setTimeout(function () {
                fileEl.removeAttribute('disabled');
            }, 100);
        }

        function getFile(event) {
            var element = event.target,
                file = element.files[0],
                imgSrc = window.URL.createObjectURL(file),
                parentEl = document.querySelector('.form-container-decor-abs');

            parentEl.style.backgroundImage = "url(" + imgSrc + ")";
            element.previousElementSibling.innerHTML = "Remove photo";
            element.setAttribute('disabled', 'disabled');
            label.addEventListener('click', clearInput);
        }

        if (fileEl) {
            fileEl.addEventListener('change', getFile);
            document.querySelector('form[name="change-store"]').addEventListener('submit', function (event) {
                event.preventDefault();
                fileEl.removeAttribute('disabled');
                event.target.submit();
            });
        }
    })();

    /* Change Avatar photo on Settings page */
    (function () {
        var fileEl = document.getElementById('user-avatar');

        function clearInput(event) {
            var el = event.target,
                img = document.querySelector('.user-component__img');

            el.classList.remove('user-component__btn-icon--del');
            fileEl.value = '';
            img.setAttribute('src', '');
            setTimeout(function () {
                fileEl.removeAttribute('disabled');
                el.removeEventListener('click', clearInput);
            }, 100);
        }

        function getFile(event) {
            var element = event.target,
                file = element.files[0],
                imgSrc = window.URL.createObjectURL(file),
                label = element.previousElementSibling,
                img = document.querySelector('.user-component__img');

            img.setAttribute('src', imgSrc);
            element.setAttribute('disabled', 'disabled');
            label.classList.add('user-component__btn-icon--del');
            label.addEventListener('click', clearInput);
        }

        if (fileEl) {
            fileEl.addEventListener('change', getFile);

            /*
                !!!!!!
            --> The form will be sent via Ajax request. Before sending, you need to remove the art attribute block from the input. Example below

             */
            // document.querySelector('form[name="change-store"]').addEventListener('submit', function(event){
            //     event.preventDefault();
            //     fileEl.removeAttribute('disabled');
            //     event.target.submit();
            // });
        }
    })();

    /* Show Logout button */
    (function () {
        var userBlock = document.querySelector('.user__name');

        function logoutHandler() {
            userBlock.classList.toggle('user__name--logout');
        }

        if (userBlock) {
            userBlock.addEventListener('click', logoutHandler);
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
            for (ki = 0; ki < s.options.length; ki++) {
                if (s.options[ki].hasAttribute('selected')) {
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