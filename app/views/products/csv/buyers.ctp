<?php
    if (!empty($orderItems)) {
        $data = array();
        foreach($orderItems as $orderItem) {
           if(!empty($orderItem['Product']['is_having_file_to_download']) || in_array($orderItem['Order']['order_status_id'], array(ConstOrderStatus::InProcess, ConstOrderStatus::Shipped, ConstOrderStatus::Completed))){
				$data[]['Buyers'] = array(
					__l('Username') => $orderItem['User']['username'],
					__l('Quantity') => $orderItem['OrderItem']['quantity'],
					__l('Top Code') => $orderItem['Order']['top_code'],
					__l('Bottom Code') => $orderItem['Order']['bottom_code'],
				);
		   }
        }
            $this->Csv->addGrid($data);
    }
echo $this->Csv->render(true);
?>