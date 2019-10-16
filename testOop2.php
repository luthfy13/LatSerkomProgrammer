<?php 
	class A{
		public function fungsi(){
			echo "Hello A<br>";
		}
	}

	class B extends A{
		public function fungsi(){
			echo "Hello B<br>";
		}

		public function fungsiParent(){
			parent::fungsi();
		}
	}

	class C extends A{
		public function fungsi(){
			echo "Hello C<br>";
		}
	}

	$b = new B();
	$b->fungsiParent();
	$b->fungsi();

	$b = new C();
	$b->fungsi();

?>