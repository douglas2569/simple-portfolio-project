import { Component, OnInit,  Input} from '@angular/core';

@Component({
  selector: 'app-my-youtube-player',
  templateUrl: './my-youtube-player.component.html',
  styleUrls: ['./my-youtube-player.component.css']
})

export class MyYoutubePlayerComponent implements OnInit {
  @Input()
  videoId!:string
  width!:number
  style:string = "width:100px"

  constructor() { }

  ngOnInit(): void {
    if(window.innerWidth >= 768){

    }else{
      this.width = window.innerWidth - 32
    }
  }

}
