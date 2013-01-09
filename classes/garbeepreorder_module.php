<?php
	class GarbeePreorder_Module extends Core_ModuleBase
	{

		protected function createModuleInfo()
		{
			return new Core_ModuleInfo(
				"Pre-order System",
				"Adds pre-order fields to products.",
				"Jonathan Garbee" );
		}

		public function subscribeEvents()
		{
			Backend::$events->addEvent('shop:onExtendProductModel', $this, 'extend_product_model');
			Backend::$events->addEvent('shop:onExtendProductForm', $this, 'extend_product_form');
		}

		public function extend_product_model($product)
		{
			$product->define_column('garbee_preorder', 'Pre-order')->type(db_bool)->defaultInvisible();
			$product->define_column('garbee_preorder_details', 'Extra details on the preorder')->type(db_text)->invisible()->validation()->fn('trim');
            $product->define_column('garbee_release_date', 'Release date for the product')->type(db_date)->defaultInvisible();
		}

		public function extend_product_form($product, $context)
		{
			$product->add_form_field('garbee_preorder','left')->comment('Is the product for pre-order?')->tab('Pre-order')->renderAs(frm_checkbox);
			$product->add_form_field('garbee_release_date', 'left')->comment('Release date for the product','above')->tab('Pre-order')->renderAs(frm_date);
			$product->add_form_field('garbee_preorder_details','left')->comment('Information to display about this preorder.','above')->tab('Pre-order')->renderAs(frm_html);
		}
	}
?>