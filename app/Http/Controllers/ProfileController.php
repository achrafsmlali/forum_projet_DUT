<?php namespace App\Http\Controllers;
use App\Http\Requests\ProfileRequest;
use App\User;
use Request;

class ProfileController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create(){
		return view('Pages.modifie');
	}

	public function updateimage($id){
		$imagedestination = 'images\profile';
		$file = Request::file('image_link');
        $image_name = time()."-".$file->getClientOriginalName();
        $file->move('images/profile', $image_name);
        create_square_image('images/profile/'. $image_name,'images/profile/'.$image_name,100);
   		\App\User::where('id',$id)->update(['image_link'=>"http://localhost:8080/images/profile/".$image_name]);
   		return redirect('edit_profile');
	}
	public function update($id,ProfileRequest $request){
		$name= Request::get('Nom_d\'utilisateur');
		$first_name=Request::get('Nom');
		$lats_name=Request::get('Prenom');
		$email=Request::get('email');
		$birthday=Request::get('date_de_naissance');
		$about_me=Request::get('about_me');
		$email_notf=Request::get('email_notf');
		$sexe=Request::get('sexe');
		$email_notf=Request::get('email_notf');

		

		\App\User::where('id',$id)->update(['name'=>$name]);
		\App\User::where('id',$id)->update(['first_name'=>$first_name]);
		\App\User::where('id',$id)->update(['lats_name'=>$lats_name]);
		\App\User::where('id',$id)->update(['email'=>$email]);
		\App\User::where('id',$id)->update(['birthday'=>$birthday]);
		\App\User::where('id',$id)->update(['about_me'=>$about_me]);
		\App\User::where('id',$id)->update(['email_notf'=>$email_notf]);
		\App\User::where('id',$id)->update(['sexe'=>$sexe]);
		\App\User::where('id',$id)->update(['email_notf'=>$email_notf]);

   		return redirect('edit_profile');
	}




	
}
function create_square_image($original_file, $destination_file=NULL, $square_size = "96"){
		
		if(isset($destination_file) and $destination_file!=NULL){
			if(!is_writable($destination_file)){
				echo '<p style="color:#FF0000">Oops, the destination path is not writable. Make that file or its parent folder wirtable.</p>'; 
			}
		}
		
		// get width and height of original image
		$imagedata = getimagesize($original_file);
		$original_width = $imagedata[0];	
		$original_height = $imagedata[1];
		
		if($original_width > $original_height){
			$new_height = $square_size;
			$new_width = $new_height*($original_width/$original_height);
		}
		if($original_height > $original_width){
			$new_width = $square_size;
			$new_height = $new_width*($original_height/$original_width);
		}
		if($original_height == $original_width){
			$new_width = $square_size;
			$new_height = $square_size;
		}
		
		$new_width = round($new_width);
		$new_height = round($new_height);
		
		// load the image
		if(substr_count(strtolower($original_file), ".jpg") or substr_count(strtolower($original_file), ".jpeg")){
			$original_image = imagecreatefromjpeg($original_file);
		}
		if(substr_count(strtolower($original_file), ".gif")){
			$original_image = imagecreatefromgif($original_file);
		}
		if(substr_count(strtolower($original_file), ".png")){
			$original_image = imagecreatefrompng($original_file);
		}
		
		$smaller_image = imagecreatetruecolor($new_width, $new_height);
		$square_image = imagecreatetruecolor($square_size, $square_size);
		
		imagecopyresampled($smaller_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
		
		if($new_width>$new_height){
			$difference = $new_width-$new_height;
			$half_difference =  round($difference/2);
			imagecopyresampled($square_image, $smaller_image, 0-$half_difference+1, 0, 0, 0, $square_size+$difference, $square_size, $new_width, $new_height);
		}
		if($new_height>$new_width){
			$difference = $new_height-$new_width;
			$half_difference =  round($difference/2);
			imagecopyresampled($square_image, $smaller_image, 0, 0-$half_difference+1, 0, 0, $square_size, $square_size+$difference, $new_width, $new_height);
		}
		if($new_height == $new_width){
			imagecopyresampled($square_image, $smaller_image, 0, 0, 0, 0, $square_size, $square_size, $new_width, $new_height);
		}
		

		// if no destination file was given then display a png		
		if(!$destination_file){
			imagepng($square_image,NULL,9);
		}
		
		// save the smaller image FILE if destination file given
		if(substr_count(strtolower($destination_file), ".jpg")){
			imagejpeg($square_image,$destination_file,100);
		}
		if(substr_count(strtolower($destination_file), ".gif")){
			imagegif($square_image,$destination_file);
		}
		if(substr_count(strtolower($destination_file), ".png")){
			imagepng($square_image,$destination_file,9);
		}

		imagedestroy($original_image);
		imagedestroy($smaller_image);
		imagedestroy($square_image);

	}
