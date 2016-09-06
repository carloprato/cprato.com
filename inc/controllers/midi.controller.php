<?php
	
	class MidiController extends BaseController {
		
		// 
		//
		//
		//

		/**
		 * List all possible actions related to this module
		 *
		 */	
		function index() {
			
			//Auth::authorise(array("editor"), true);
			$midi = new MidiModel;
			$midis = $midi->getMidiList("LIMIT 10", "ORDER BY downloads DESC");               			
			$midi_new = $midi->getNewMidi();                        
			TemplateController::set("midi_new", $midi_new);
			TemplateController::set("midi_list", $midis);
		}

		function all() {

			//Auth::authorise(array("editor"), true);
			$midi = new MidiModel;
			$midis = $midi->getMidiList("ORDER BY artist ASC");               			
			TemplateController::set("midi_list", $midis);			
		}
		
		function details($midi_id, $midi_url) {
			        		
			$midi = new MidiModel;
			$midi_details = $midi->getMidi($midi_id);
			$midi_details[0]['key'] = $midi->generateKey(time());
            TemplateController::set("midi_details", $midi_details);
		}

		function download($id, $slug, $key) {

			$midi = new MidiModel;
			$midi_details = $midi->getMidi($id);
			if ($midi->isKeyValid($key) == FALSE) {
				header("Location: /download.php?id=" . $midi_details[0]['id'] . "&key=" . $key);
			}			
			$midi_details[0]['key'] = $key;
            TemplateController::set("midi_details", $midi_details);
		}

		function file($midi_id, $midi_url, $key) {
			        		
			$midi = new MidiModel;
			$midi_details = $midi->getMidi($midi_id);
			$file_url = $_SERVER['DOCUMENT_ROOT'] ."/midi/".$midi_details[0]['url'];

			if ($midi->isKeyValid($key) == FALSE) {
				header("Location: /en/midi/details/" . $midi_id . "/" . $midi_details[0]['slug']);
			} else if (!file_exists($file_url)) {
				header("Location: /en/midi/not_found");
			} else {
				header('Content-Type: audio/midi');
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
				header('Content-Length: '.filesize($file_url));
				header('Content-disposition: attachment; filename="' . basename($file_url) . '"'); 
                readfile($file_url);
				
			}

            TemplateController::set("midi_details", $midi_details);

		}

		function getBeatport() {
			
			Auth::authorise(array("editor"), true);

			$midi = new MidiModel;
			if (isset($_POST['beatport_id'])) {
				$beatport = $midi->getBeatport($_POST['beatport_id']);
				print_r($beatport);
			//$midi->upload($id);
			//$midis = $midi->insert($_POST);               			                     
			TemplateController::set("midi_list", $midis);
			
			}
		}

		function insert($id) {
			
			Auth::authorise(array("editor"), true);

			$midi = new MidiModel;
			if (isset($_POST['beatport_id'])) {
			
			$file = $midi->upload($id);
			$json = $midi->getBeatport($id);
			$midi->insert($json, $file);           			                     
			
			TemplateController::set("midi_list", $midis);
			
			}
		}

		function not_found() {

            TemplateController::set("error", "MIDI file not found.");

		}

		function search($keyword) {
			        		
			$midi = new MidiModel;
			$midi_details = $midi->search($keyword);
            TemplateController::set("midi_details", $midi_details);

		}
		function delete($file) {
			
			Auth::authorise(array("editor"), true);			

			$editor = new EditorModel;
			$editor->delete($file);			
			header("Location: /en/editor");
		}
		
		function edit($page_id) {
			// Edits a created static page
			Auth::authorise(array("editor"), true);

			if (!empty($_POST['page_content'])) {
				
				$editor = new EditorModel;
				$editor->update($page_id, $_POST['page_content']);
				header('Location: /en/editor/edit/'. $this->arg); // !!! Let's code something better when we have time
			}

			$editor = new EditorModel;
			$page = $editor->getPage($page_id);			
			TemplateController::set("page_content", htmlentities($page->content));			
		}

	}