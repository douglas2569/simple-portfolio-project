import { Component, OnInit } from '@angular/core';
import CoverPhoto from 'src/app/models/CoverPhoto';
import { CoverPhotoService } from 'src/app/services/coverphoto.service';

@Component({
  selector: 'app-cover',
  templateUrl: './cover.component.html',
  styleUrls: ['./cover.component.css']
})
export class CoverComponent implements OnInit {
  photoCover!:Array<CoverPhoto>

  constructor(private coverPhoto:CoverPhotoService) { }

  ngOnInit(): void {
    this.mount()
  }

  mount():void{

    this.coverPhoto.getCoverPhoto().subscribe((data)=>{
      console.log(data)
    })
  }

}
