<?

class ConnectFour {
	/**
	 * Initialise rows and columns for the board
	 * 
	 */
	protected $_horizontal = 8; 
	protected $_vertical = 6;

	/**
	 * A mirror of the board
	 * 0 = default, 1 = 1st player, 2 = 2nd player
	 *
	 */
	protected $_board_as_an_array = array();

	/**
	 * Current player
	 * Player 1 = 1, Player 2 = 2 (max 2 players according to rules) 
	 * Assumption Player 1 always starts first
	 *
	 */
	protected $_current_player = 1;

	/**
	 * Track moves executed by both players.
	 * 
	 * @var int
	 */
	protected $_moves = 0;


	/**
	 * Constructor
	 * Starts game
	 *
	 */
	function __construct(){
		$this->_start();
	}


	/**
	 * Sets number of rows
	 * 
	 * @param int $verticals
	 */
	public function setHorizontal($verticals = 6) {
	
		 $this->_horizontal = $verticals;
	
	}
	
	/**
	 * Gets number of rows for the board
	 * 
	 * @return int
	 */
	public function getHorizontal() {
		
		return $this->_horizontal;
		
	}
	
	/**
	 * Sets number of columns for the board
	 * 
	 * @param int $horizontal
	 */
	public function setVertical($horizontal = 6) {
	
		$this->_vertical = $horizontal;
	
	}
	
	/**
	 * Gets number of columns for the board
	 * 
	 * @return int
	 */
	public function getVertical() {
	
		return $this->_vertical;
	
	}


	/**
	 * Get the current board in the form of an array
	 * 
	 * @return array
	 */
	protected function _getCurrentBoard() {
	
		return $this->_board_as_an_array;
			
	}
	
	/**
	 * Sets the current board
	 */
	protected function _setCurrentBoard($current_board) {
	
		$this->_board_as_an_array = $current_board;
			
	}


	/**
	 * Gets the current player
	 * 
	 * @return int
	 */
	protected function _getCurrentPlayer() {
	
		return $this->_current_player;
			
	}
	
	/**
	 * Sets the current player
	 */
	protected function _setCurrentPlayer($player_num) {
	
		$this->_current_player = $player_num;
			
	}


	/**
	 * Gets the number of moves
	 * 
	 * @return int
	 */
	protected function _getMoves() {
	
		return $this->_moves;
			
	}
	
	/**
	 * Sets the number of moves
	 */
	protected function _setMoves($moves) {
	
		$this->_moves = $moves;
			
	}


	/**
	 * Start game
	 *
	 */
	protected function _start() {
		$this->_initBoard($this->_horizontal, $this->_vertical);

		//start
		$this->_dropPiece(1);
	}


	/**
	 * Draw the board also set $_board_as_an_array to be like the board
	 */
	protected function _initBoard() {
		//reset
		$board = array();

		for ($i = 0; $i < $this->getVertical(); $i++) {
			for ($j = 0; $j < $this->getHorizontal(); $j++) {
				//set the board_as_an_array (rows, columns)
				//no value = 0, 1st player = 1, 2nd player = 2
				$board[$i][$j] = 0;

				$this->_drawPiece($board[$i][$j]);
			}

			echo "<br />";
		}

		echo "------------------------<br />";
	}


	/**
	 * Draw the board also set $_board_as_an_array to be like the board
	 */
	protected function _drawUpdatedBoard() {
		$board = $this->_getCurrentBoard();

		for ($i = 0; $i < $this->getVertical(); $i++) {
			for ($j = 0; $j < $this->getHorizontal(); $j++) {
				$this->_drawPiece(!empty($board[$i][$j]) ? $board[$i][$j] : 0);
			}

			echo "<br />";
		}

		echo "------------------------<br />";
	}


	/**
	 * Output the text, symbol, etc to show the board
	 */
	protected function _drawPiece($player_number = 0) {
		$output = "";

		switch ($player_number) {
			case 1:
				$output = "  x  ";
				break;
			case 2:
				$output = "  o  ";
				break;
			default: 
				$output = "  *  ";
				break;
		}

		echo $output;
	}


	/**
	 * Sets player turn
	 */
	protected function _togglePlayerTurn() {
		$this->_setCurrentPlayer($this->_getCurrentPlayer() === 1 ? 2 : 1);
	}


	/**
	 * Sets player turn
	 */
	protected function _dropPiece($horizontal) {
		//only do something if $vertical is available
		if (!empty($horizontal)) {
			//check number of moves is not greater than number of spaces
			$total_moves = $this->_getMoves();
			$total_spaces = $this->getVertical() * $this->getHorizontal();
			if ($total_moves >= $total_spaces) {
				//max number of moves reached, end game
				//display a draw message
			}

			$board = $this->_getCurrentBoard();
			
			//check if there is a piece at beneath it / at the bottom of the board
			for ($i = $this->getVertical() - 1; $i >= 0; $i--) {
				//slot empty
				if (empty($board[$i][$horizontal])) {
					
					//Set slot to current player
					$board[$i][$horizontal] = $this->_getCurrentPlayer();

					//update board
					$this->_setCurrentBoard($board);

					//draw updated board
					$this->_drawUpdatedBoard();

					//increment moves
					$this->_setMoves($total_moves++);

					if ($this->_checkForWin($i, $horizontal)) {
						//check for a win
						//display win message

						return false;
					} else {
						//change player turn
						$this->_togglePlayerTurn();
					}
				}
			}
		}
	}



	/**
	 * Check for winner
	 * 
	 * @return boolean
	 */
	protected function _checkForWin($vertical, $horizontal) {
		
		if ($this->_checkHorizontalWin($vertical, $horizontal) || $this->_checkVerticalWin($vertical, $horizontal) || $this->_checkDiagonalRightWin($vertical, $horizontal)  || $this->_checkDiagonalLeftWin($vertical, $horizontal)){
			return true;
		}
		
		return false;
		
	}
	
	/**
	 * Check for horizontal pieces
	 * 
	 * @return boolean
	 */
	private function _checkHorizontalWin($vertical, $horizontal) {
		$board = $this->_getCurrentBoard();
		$player = !empty($board[$vertical][$horizontal]) ? $board[$vertical][$horizontal] : 0;
		$count = 0;
		
		//count right
		for ($i = $horizontal + 1; $i < $this->getHorizontal(); $i++) {
				
			if (!empty($board[$vertical][$i]) && $board[$vertical][$i] !== $player) {
				break;
			}
				
			$count++;
		}

		//count left
		for ($i = $horizontal; $i >= 0; $i--) {
			if (!empty($board[$vertical][$i]) && $board[$vertical][$i] !== $player) {
				break;
			}
			
			$count++;
		}
		
		return $count >= 4 ? true : false;
	}
	
	/**
	 * Check for vertical pieces
	 * 
	 * @return boolean
	 */
	private function _checkVerticalWin($vertical, $horizontal) {
	
		//check if more than 4 pieces from the bottom
		if ($vertical >= $this->getVertical() - 3) {
			return false;
		}
		
		$board = $this->_getCurrentBoard();
		$player = $board[$vertical][$horizontal];
		
		for ($i = $vertical + 1; $i <= $vertical + 3; $i++) {
			
			if ($board[$i][$horizontal] !== $player) {
				return false;	
			}
		}
		
		return true;
	}


	/**
	 * Check for diagonal right pieces
	 * 
	 * @return boolean
	 */
	private function _checkDiagonalRightWin($vertical, $horizontal) {
	    $board = $this->_getCurrentBoard();
		$player = $board[$vertical][$horizontal];
		$count = 0;
	 
		/*
			check for win to the right up by counting the horizontal + 1 and vertical + 1
			counter is 4 then it's a win
                 _|
			    _|
			  _|
			_|
			------>
		*/

		/*
			check for win to the right down by counting the horizontal + 1 and vertical - 1
			counter is 4 then it's a win
            _|
			  _|
			    _|
			      _|
			------>
		*/

    	return $count >= 4 ? true : false;
	}


	/**
	 * Check for vertical pieces
	 * 
	 * @return boolean
	 */
	private function _checkDiagonalLeftWin($vertical, $horizontal) {
		$board = $this->_getCurrentBoard();
		$player = $board[$vertical][$horizontal];
		$count = 0;
	 
		/*
			check for win to the left up by counting the horizontal - 1 and vertical + 1
			counter is 4 then it's a win
			_|
			  _|
			    _|
			      _|
			<------
		*/

		/*
			check for win to the left down by counting the horizontal - 1 and vertical - 1
			counter is 4 then it's a win
                 _|
			    _|
			  _|
			_|
			<------
		*/

    	return $count >= 4 ? true : false;
	}

}

?>