<a href="" title="Book Now">Book Now</a>

<div class="wrapper">
  <div id="booking-widget-range" class="dates">
    <input class="date-range" />
    <input type="text" class="start" name="arrive" readonly value="" title="<?php _e( 'Date from', 'linehotel' ); ?>">
    <input type="text" class="end" name="depart" readonly value="" title="<?php _e( 'Date to', 'linehotel' ); ?>">
    <div class="calendar"></div>
  </div>
</div>

<?php  
/* Booking Form */
?>
<form action="https://gc.synxis.com/rez.aspx" class="book-form" target="_blank">
  <fieldset>
    <legend class="hidden"><?php _e( 'book form', 'linehotel' ); ?></legend>
    <div class="elements">
            <input type="hidden" name="Hotel" value="<?php echo $hotel_id; ?>">
           
            <input type="hidden" name="Chain" value="<?php echo $chain_id; ?>">
      <div class="row-form calendar-popup">
        <a href="#" class="opener" data-placeholder='<?php _e( 'Check in - Check out', 'linehotel' ); ?><span class="icon-calendar">' ></span></a>
        <input type="text" class="start hidden" name="arrive" readonly value="" title="<?php _e( 'Date from', 'linehotel' ); ?>">
        <input type="text" class="end hidden" name="depart" readonly value="" title="<?php _e( 'Date to', 'linehotel' ); ?>">
        <input type="hidden" name="start" value="availresults">
        <?php 
       // $min_date = get_min_date();

        ?>
        <input type="hidden" name="reservation_start_date" class="reservation_start_date" value="<?php echo $min_date ?>">
        <div class="calendar"></div>
      </div>

      <div class="row-form">
        <select name="adult">
          <option><?php _e( 'N&deg; guests', 'linehotel' ); ?></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>
      <div class="row-form">
        <div class="opt-holder">
          <input type="text" name="promo_code" title="promo code" placeholder="<?php _e( 'Promo Code', 'linehotel' ); ?>">
          <span class="text"><?php _e( 'opt', 'linehotel' ); ?></span>
        </div>
      </div>
    </div>
    <input type="submit" value="<?php _e( 'Check Availability', 'linehotel' ); ?>">
    <!-- <input name="_ga" class="hidden location-value" type="text"> -->
  </fieldset>
</form>
