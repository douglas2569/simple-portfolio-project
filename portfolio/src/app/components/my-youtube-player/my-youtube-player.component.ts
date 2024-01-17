import { Component, OnInit,  Input} from '@angular/core';

@Component({
  selector: 'app-my-youtube-player',
  templateUrl: './my-youtube-player.component.html',
  styleUrls: ['./my-youtube-player.component.css']
})

export class MyYoutubePlayerComponent implements OnInit {
  width!: number
  @Input()
  videoId!:string
  @Input()
  style!:string

  constructor() { }

  ngOnInit(): void {
    this.width = window.innerWidth - 32;
  }

}
