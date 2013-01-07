<?php

	class GarbeePreorder_Module extends Core_ModuleBase
	{
		/**
		 * Creates the module information object
		 * @return Core_ModuleInfo
		 */
		protected function createModuleInfo()
		{
			return new Core_ModuleInfo(
				"Extra product preorder",
				"Adds extra preorder configurations to a product",
				"Jonathan Garbee" );
		}

		public function subscribeEvents()
		{
			Backend::$events->addEvent('shop:onExtendProductModel', $this, 'extend_product_model');
			Backend::$events->addEvent('shop:onExtendProductForm', $this, 'extend_product_form');
		}

		public function extend_product_model($product)
		{
			$product->define_column('garbee_preorder', 'Preorder');
			$product->define_column('garbee_preorder_details', 'Extra details on the preorder')->invisible()->validation()->fn('trim');
            $product->define_column('garbee_release_date', 'Release date for the product')->type(db_date)->defaultInvisible();
		}

		public function extend_product_form($product, $context)
		{
			$product->add_form_field('garbee_preorder')->comment('Is this product available for preorder?')->tab('Inventory')->renderAs(frm_checkbox);
			$product->add_form_field('garbee_preorder_details','left')->comment('Information to display about this preorder.')->tab('Inventory')->renderAs(frm_html);
			$product->add_form_field('garbee_release_date', 'right')->comment('Release date for the product')->tab('Inventory')->renderAs(frm_date);
		}
	}

?>