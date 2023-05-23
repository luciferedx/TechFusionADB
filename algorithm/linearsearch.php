<?php
    function linearSearch($orders, $searchOrderId) {
                foreach ($orders as $order) {
                    if ($order['id'] == $searchOrderId) {
                        return $order;
                    }
                }
                return null; // Order ID not found
            }