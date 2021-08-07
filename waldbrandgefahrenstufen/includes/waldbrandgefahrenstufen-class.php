<?php


class Waldbrandgefahrenstufen_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'Waldbrandgefahrenstufen_widget', // Base ID
            esc_html__('Waldbrandgefahrenstufe', 'wbs_domain'), // Name
            array('description' => esc_html__('Zeigt die Waldbrandgefahrenstufe für jede Stadt in deutschland an und informiert somit die Bevölkerung und kann dadurch präventiv Waldbrände verhindern', 'wbs_domain'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }


        if ($instance['layout'] == 'default') {
            echo '<script>
        fetchAsync("' . $instance['city'] . '")
  .then(
    (data) =>
      (document.getElementById("wbs1").innerHTML =
        \'<div style="height:100%;width:100%;display: flex;flex-direction: column;align-items: center;justify-content: center;"><div style="height:100px; width:100px; background-color:\' +
        data.color +
        \';border-radius:50px; border-width:3px;border-color:black; border-style:solid; display: flex; align-items: center;justify-content: center;"><p style="font-size:50px;font-weight:bolder;margin: unset !important;text-align:none !important;">\' +
        data.wbs +
        \'</p></div><div style="margin-top:0.5vh; font-size:0.7em"><a href="\' +
        data.source +
        \'" target="_blank">WBS-API by Niklas Ullmann</a></div></div>\')
  )
  .catch(
    (reason) =>
      (document.getElementById("wbs1").innerHTML =
        \'<div style="height:100%;width:100%;display: flex;flex-direction: column;align-items: center;justify-content: center;"><h3>Fehler beim Laden von Daten</h3></div>\')
  );
        </script><div id="wbs1"></div>';
        } elseif ($instance['layout'] == 'klein') {

            echo '<script>
              fetchAsync("' . $instance['city'] . '")
                .then(
                  (data) =>
                    (document.getElementById("wbs2").innerHTML =
                      \'<div style="height:100%;width:100%;display: flex;flex-direction: column;align-items: center;justify-content: center;"><div style="height:50px; width:50px; background-color:\' +
                      data.color +
                      \';border-radius:25px; border-width:3px;border-color:black; border-style:solid; display: flex; align-items: center;justify-content: center;"><p style="font-size:25px;font-weight:bolder;margin: unset !important;text-align:none !important;">\' +
                      data.wbs +
                      \'</p></div><div style="margin-top:0.5vh; font-size:0.7em"><a href="\' +
                      data.source +
                      \'" target="_blank">by N. Ullmann</a></div></div>\')
                )
                .catch(
                  (reason) =>
                    (document.getElementById("wbs2").innerHTML =
                      \'<div style="height:100%;width:100%;display: flex;flex-direction: column;align-items: center;justify-content: center;"><h3>Fehler beim Laden von Daten</h3></div>\')
                ); </script><div id="wbs2"></div>';
        } elseif ($instance['layout'] == 'ausf') {

            echo '<script>
            fetchAsync("' . $instance['city'] . '")
    .then(
      (data) =>
        (document.getElementById("wbs1").innerHTML =
          \'<div style="height:100%;width:100%;display: flex;flex-direction: column;align-items: center;justify-content: center;"><div style="height:100px; width:100px; background-color:\' +
          data.color +
          \';border-radius:50px; border-width:3px;border-color:black; border-style:solid; display: flex; align-items: center;justify-content: center;"><p style="font-size:50px;font-weight:bolder;margin: unset !important;text-align:none !important;">\' +
          data.wbs +
          \'</p></div></br>(\' +
          data.text +
          \')<div style="margin-top:0.5vh; font-size:0.7em"><a href="\' +
          data.source +
          \'" target="_blank">WBS-API by Niklas Ullmann</a></div></div>\')
    )
    .catch(
      (reason) =>
        (document.getElementById("wbs1").innerHTML =
          \'<div style="height:100%;width:100%;display: flex;flex-direction: column;align-items: center;justify-content: center;"><h3>Fehler beim Laden von Daten</h3></div>\')
    ); </script> <div id="wbs1"></div>';
        } else {
            echo 'PHP Error';
        }


        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Waldbrandgefahrenstufe:', 'wbs_domain');
        $city = !empty($instance['city']) ? $instance['city'] : esc_html__('Potsdam', 'wbs_domain');
        $layout = !empty($instance['layout']) ? $instance['layout'] : esc_html__('default', 'wbs_domain');

?>
        <!-- Titel -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'wbs_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <!-- Stadtname -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('city')); ?>"><?php esc_attr_e('Stadt:', 'wbs_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('city')); ?>" name="<?php echo esc_attr($this->get_field_name('city')); ?>" type="text" value="<?php echo esc_attr($city); ?>">
        </p>

        <!-- LAYOUT -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('layout')); ?>">
                <?php esc_attr_e('Layout:', 'wbs_domain'); ?>
            </label>

            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('layout')); ?>" name="<?php echo esc_attr($this->get_field_name('layout')); ?>">
                <option value="default" <?php echo ($layout == 'default') ? 'selected' : ''; ?>>
                    Normal
                </option>
                <option value="klein" <?php echo ($layout == 'klein') ? 'selected' : ''; ?>>
                    Klein
                </option>
                <option value="ausf" <?php echo ($layout == 'ausf') ? 'selected' : ''; ?>>
                    Ausführlich
                </option>
            </select>
        </p>
<?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['city'] = (!empty($new_instance['city'])) ? sanitize_text_field($new_instance['city']) : '';

        $instance['layout'] = (!empty($new_instance['layout'])) ? strip_tags($new_instance['layout']) : '';


        return $instance;
    }
}
