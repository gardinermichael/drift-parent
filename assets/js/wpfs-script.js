/* global twentyseventeenScreenReaderText */
(function( $ ) {

    /**
     * Wrap desciption text in span tag so we can style as designed
     */
    const form = $( '.wpfs-form' );
    if( ! form ) {
        return;
    }

    const formType = form.data( 'wpfs-form-type' );
    const fieldNodes = $( 'fieldset.wpfs-form-check-group .wpfs-form-check' );

    if( fieldNodes ) {
        const shippingAddressLabelEl = $("label[for^='wpfs-shipping-address-line-1']");
        const billingAddressLabelEl = $("label[for^='wpfs-billing-address-line-1']");
        const cardHolderLabelEl = $("label[for^='wpfs-card-holder-name']");

        if (cardHolderLabelEl) {
            cardHolderLabelEl.text( cardHolderLabelEl.text().replace( 'Card holder’s name' , 'Full name' ) );
        }

        if (shippingAddressLabelEl) {
            shippingAddressLabelEl.text( shippingAddressLabelEl.text().replace( 'Shipping address street' , 'Shipping address' ) );
        }

        if (billingAddressLabelEl) {
            billingAddressLabelEl.text( billingAddressLabelEl.text().replace( 'Billing address street' , 'Billing address' ) );
        }
        
        if( 'inline_subscription' === formType ) {
            formatSubscriptions();
        }

        if( 'inline_payment' === formType ) {
            formatPayments();
            moveCustomAmountField();
            addWrapper();
        }
    }

    function formatSubscriptions() {
        fieldNodes.each( function( index, value ) {
            let $input = $( this ).find( 'input' );
            let $label = $( this ).find( '.wpfs-form-check-label' );
            let $amount =  $input.data( 'wpfs-plan-amount' );
            let $currency = $input.data( 'wpfs-currency' );
            let $planName = $input.data( 'wpfs-product-name' );

            let amount = new Intl.NumberFormat( 'en-US', { 
                style: 'currency', 
                currency: $currency,
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            } ).format( $amount );

            let $description = '<span class="constrained">' + $planName + '</span>';
            let $price = '<strong>' + amount + '</strong>';
            $label.html( $description + $price );
        } );
    }

    function formatPayments() {
        fieldNodes.each( function( index, value ) {
            let $input = $( this ).find( 'input' );
            let $label = $( this ).find( '.wpfs-form-check-label' );
            let $amount =  $input.val();
            let $currency = $input.data( 'wpfs-currency' );
            let $productName = ( $input.data( 'wpfs-product-name' ) ) ? $input.data( 'wpfs-product-name' ) : '';
            // let $description =  $input.data( 'wpfs-amount-description' );

            let amount = $amount;

            if( 'other' != $amount ) {
                amount = new Intl.NumberFormat( 'en-US', { 
                    style: 'currency', 
                    currency: $currency,
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                } ).format( $amount );       
            } 

            let $description = ( $productName ) ? '<span class="constrained">' + $productName + '</span>' : '';
            
            let $price = '<strong>' + amount + '</strong>';
            $label.html( $description + $price );

            // $label.html( $description );
        } );
    }

    function addWrapper() {
        let fieldSet = $( '.wpfs-form-check-group' );
        if( fieldSet ) {
            fieldSet.wrapInner( '<div class="fieldset-wrapper"></div>' );
        }
    }

    function moveCustomAmountField() {
        const parent = document.querySelector(`.wpfs-form-check-group`);
        const field = document.querySelector(`[data-wpfs-amount-row='custom-amount']`);

        if( parent && field ) {
            parent.insertAdjacentHTML( 'beforeend', field.outerHTML );
            field.remove();
        }
    }

})( jQuery );
