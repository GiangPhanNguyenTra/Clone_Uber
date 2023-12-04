const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const xhttp = new XMLHttpRequest();
const formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'VND',
  
    // These options are needed to round to whole numbers if that's what you want.
    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
    maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
  });


var loader = $('.loader');
var headerUnfixed = $('.header-unfixed');
var haederFixed = $('.header-wrapper-fixed');
var scrollToTop = $('.scroll-top');
var notifierBtns = $$('.header__right-notifier');
var notifierOverlay = $('.notifier-overlay');
var notifierFixed = $('.notifier-fixed');
var line = $('div.line');
var sectionNav = $$('.section-nav li');
var formInputs = $$('.form-gruop');
var toast = $('.toast');
var toastContent = $('.toast_content');
var toastCloseBtn = $('.toast span');
var sectionContent = $$('.section-content_text');
var userAvatas = $$('span.user-tie');
var userDropdownMenus = $$('.user-dropdown-menu-contain');
var submitBtn = $('.submit-btn');
var inputQuatinty = $('.input-quatinty input')
var inputMinus = $('.minus');
var inputPlus = $('.plus');
// var btnsAddCartItem = $$('.add-cart-item');
var cartDetailTable = $('.cart-table');
var userLayouts = $$('.user-layout');
var imageAvataUpload = $('#img-upload');
var btnsConfirmOrder = $$('.btn-confirm-order');
var confirmModel = $('.confirm-model');
var cancelOrderModel = $('.cancel-model');
var btnsCancelOrder = $$('.btn-cancel-order');
var inputSortProduct = $('.sort-product-field');
var btnSubmitSearchProducts = $('.options_search button');
var submitFilter = $('.submit-filter');


const app = {

    defaultWidthLine: () => {
        line.style.left = sectionNav[0].offsetLeft + 'px';
        line.style.width = sectionNav[0].offsetWidth + 'px';
    },

    domeEventListener: () => {

        window.onload = () => {
            loader.classList.add('loader-hidden'); 
        }

        var oldScrollValue = 0;

        window.onscroll = () => {
            var newScrollValue = window.pageYOffset;
            if (newScrollValue > oldScrollValue) {
                app.handdleLogic.headerUnfixedOff();
                app.handdleLogic.haederFixedOn();
                if (newScrollValue > 100) {
                    app.handdleLogic.scrollToTopOn();
                }
            } else {
                if (newScrollValue < 40) {
                    app.handdleLogic.haederFixedOff();
                    app.handdleLogic.headerUnfixedOn();
                    app.handdleLogic.scrollToTopOff();
                    userLayouts[1] && userLayouts[1].classList.remove('active');
                }
            }

            oldScrollValue = newScrollValue;
        }

        scrollToTop.onclick = () => {
            app.handdleLogic.toTop();
        }

        for (var notifierBtn of notifierBtns) {
            notifierBtn.onclick = () => {
                app.handdleLogic.openNotifierOverlay();
                setTimeout(app.handdleLogic.openNotifierFixed(), 200);
            }
        }

        notifierOverlay.onclick = () => {
            app.handdleLogic.closeNotifierFixed();
            setTimeout(app.handdleLogic.closeNotifierOverlay(), 500);
        }

        sectionNav.forEach((sectionItem, index) => {
            sectionItem.onclick = () => {
                var sectionContentActive = $('.section-content_text.active');
                
                var SectionNavAccountActive = $('.section-nav-account li.active') || '';
                if (SectionNavAccountActive != '') {
                    SectionNavAccountActive.classList.remove('active');
                    sectionNav[index].classList.add('active');
                }

                sectionContentActive.classList.remove('active');
                sectionContent[index].classList.add('active');

                var lineLeft = sectionItem.offsetLeft + 'px';
                var LineWidth = sectionItem.offsetWidth + 'px';
            
                app.handdleLogic.changeDefaultWidthLine(lineLeft, LineWidth);
            }
        })

        toastCloseBtn.onclick = () => {
            toast.classList.remove('active');
        }

        userAvatas.forEach((userAvata, index) => {
            userAvata.onclick = () => {
                app.handdleLogic.changeStatusDropdown(index);
                userLayouts[index].classList.toggle('active');
            }
        })

        userLayouts.forEach((userLayout, index) => {
            userLayout.onclick = () => {
                app.handdleLogic.changeStatusDropdown(index);
                userLayouts[index].classList.toggle('active');
            }
        });

        if (submitBtn) {
            submitBtn.onclick = () => {
                submitBtn.innerHTML = '<div class="loader-btn"></div>';
                //submitBtn.setAttribute('disabled', true);
                console.log('submit');
            }
        }
        
        if (inputMinus) {
            inputMinus.onclick = () => {
                app.handdleLogic.handleInputQuantity('-', inputQuatinty);
            }
        }
        
        if (inputPlus) {
            inputPlus.onclick = () => {
                app.handdleLogic.handleInputQuantity('+', inputQuatinty);
            }
        }

        notifierFixed.onclick = (e) => {
            if (e.target.closest('.del-cart-item')) {
                app.handdleLogic.deleteCartItem(e.target.closest('.del-cart-item').dataset.id);
            }
            if (e.target.closest('.notifier-fixed-close-btn')) {
                app.handdleLogic.closeNotifierFixed();
                setTimeout(app.handdleLogic.closeNotifierOverlay(), 500);
            }
        }

        if (imageAvataUpload) {
            imageAvataUpload.onchange = () => {
                // imageAvataUpload.files[0] : lấy thông tin của file
                if (imageAvataUpload.files[0]) {

                    // khởi tạo interface File Reader
                    const reader = new FileReader();

                    reader.onload = () => {
                        $('.img-user img').setAttribute('src', reader.result);
                        // reader.result nội dung của file sau khi đã đọc xong ở dưới
                    }
                    
                    // bắt đầu đọc dữ liệu file, sau khi đọc xong reader.result sẽ là một url đại diện cho file đã được đọc
                    reader.readAsDataURL(imageAvataUpload.files[0]);
                }

                // FileReader sử dụng quy tắc bất đồng bộ.
            }
        }
    },

    handdleLogic: {
        haederFixedOn: () => {
            haederFixed.classList.add('active');
        },
        haederFixedOff: () => {
            haederFixed.classList.remove('active');
            if (userDropdownMenus[1]) {
                userDropdownMenus[1].classList.remove('active');
            }
        },
        headerUnfixedOff: () => {
            headerUnfixed.classList.add('active');
            if(userDropdownMenus[0]) {
                userDropdownMenus[0].classList.remove('active');
                userLayouts[0].classList.remove('active');
            }
        },
        headerUnfixedOn: () => {
            headerUnfixed.classList.remove('active');
        },
        scrollToTopOn: () => {
            scrollToTop.classList.add('active');
        },
        scrollToTopOff: () => {
            scrollToTop.classList.remove('active');
        },
        toTop: () => {
            window.scrollTo({top: 0, behavior: 'smooth'});
        },
        openNotifierFixed: () => {
            notifierFixed.classList.add('active');
        },
        openNotifierOverlay: () => {
            notifierOverlay.classList.add('active');
        },
        closeNotifierFixed: () => {
            notifierFixed.classList.remove('active');
        },
        closeNotifierOverlay: () => {
            notifierOverlay.classList.remove('active');
            if (confirmModel.classList.contains('active')) {
                confirmModel.classList.remove('active')
            } else if (cancelOrderModel.classList.contains('active')) {
                cancelOrderModel.classList.remove('active')
            }
        },
        changeDefaultWidthLine: (left, width) => {
            line.style.left = left;
            line.style.width = width;
        },
        changeStatusDropdown: (index) => {
            userDropdownMenus[index].classList.toggle('active');
        },

        defaultCheckNotification: () => {
            console.log(notifierFixed.children.length);
            $$('.cart-count').forEach((item) => {item.innerHTML= '(' + notifierFixed.children.length + ')'});
        },
    },
    toastShow: () => {
        if (toastContent.innerHTML) {
            toast.classList.add('active');
        }

        setTimeout(() => {
            if (toast.classList.contains('active')) {
                toast.classList.remove('active');
            } else {
                return;
            }
        }, 5000)
    },

    start: () => {

        app.domeEventListener();
        app.toastShow();
        app.handdleLogic.defaultCheckNotification();

        if (line) {
            app.defaultWidthLine()
        }
    }
}

app.start();

