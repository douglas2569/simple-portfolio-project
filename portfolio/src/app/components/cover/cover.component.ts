import { Component, OnInit } from '@angular/core';
import CoverPhoto from 'src/app/models/CoverPhoto';
import { CoverPhotoService } from 'src/app/services/coverphoto.service';

@Component({
  selector: 'app-cover',
  templateUrl: './cover.component.html',
  styleUrls: ['./cover.component.css']
})
export class CoverComponent implements OnInit {
  coverPhoto!:Array<CoverPhoto>

  constructor(private coverPhotoService:CoverPhotoService) { }

  ngOnInit(): void {
    this.mount()
  }

  mount():void{

    this.coverPhotoService.getCoverPhoto().subscribe((response)=>{
      console.log(response)
      console.log(response.error)
      console.log(response.data)
      console.log(typeof response.data)

    })
  }

}
