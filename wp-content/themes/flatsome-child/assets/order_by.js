(function ($) {
    $(document).ready(function () {
        jQuery("#woocommerce-ordering option").each(function(i, e) {
            (jQuery("<input type='radio' name='r' />")
            .attr("value", jQuery(this).val())
            .attr("checked", i == 0)
            .click(function() {
                jQuery("#woocommerce-ordering").val(jQuery(this).val());
            }).add($("<label>"+ this.textContent +"</label>")))
            .appendTo("#r");
        });
        $('#woocommerce-ordering').on('change', function() {
            alert(1121);
            this.form.submit();
        });
    });
})(jQuery)