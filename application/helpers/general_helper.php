<?php
/**
 * shows message as error text
 * @author Mohamed Rashid C <https://twitter.com/rashivkp>
 * @param string $message
 * @return string
 */
function error_message($message = '')
{
    return '<div class="text-error"> <i class="icon-warning-sign"></i><strong> ' . $message . '</strong></div>';
}

/**
 * shows message as alert
 * @author Mohamed Rashid C <https://twitter.com/rashivkp>
 * @param string $message
 * @param string $css_class
 * @return string
 */
function set_message($message, $css_class = '')
{
    get_instance()->session->set_flashdata('message', '
        <div class="alert ' . $css_class . '">
                            <button data-dismiss="alert" class="close" type="button">&times;</button>
                            <h4>' . $message . '</h4>
                        </div>');
}

/* End of file general_helper.php
 * Location : application/helpers/general_helper.php
 */
