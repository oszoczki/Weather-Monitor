import jQuery from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';

// Make jQuery available globally
window.$ = window.jQuery = jQuery;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2 on all select elements with the select2 class
    jQuery('.select2').select2({
        theme: 'tailwind',
        width: '100%',
        placeholder: 'Válassz opciót',
        allowClear: true,
        language: {
            noResults: function() {
                return "Nincs találat";
            },
            searching: function() {
                return "Keresés...";
            },
            inputTooLong: function(args) {
                return "Túl hosszú a keresési kifejezés";
            }
        },
        containerCssClass: 'w-full',
        selectionCssClass: 'w-full h-[42px] border border-gray-300 rounded-md bg-white px-3 py-2 text-gray-900 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500',
        dropdownCssClass: 'w-full border border-gray-300 rounded-md bg-white shadow-lg',
        searchCssClass: 'w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500',
        resultsCssClass: 'w-full',
        optionCssClass: 'px-3 py-2 text-sm text-gray-900 hover:bg-gray-50 cursor-pointer',
        highlightedCssClass: 'bg-blue-500 text-white',
        selectedCssClass: 'bg-gray-50',
        disabledCssClass: 'opacity-50 cursor-not-allowed',
        clearCssClass: 'text-gray-500 hover:text-red-500 cursor-pointer mr-8',
        dropdownParentCssClass: 'w-full'
    });
}); 