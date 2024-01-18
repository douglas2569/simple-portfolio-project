import { Component, OnInit } from '@angular/core';
import { dataBase } from 'src/app/database';
import { Database, Covers } from '../../models/database';

@Component({
  selector: 'app-cover',
  templateUrl: './cover.component.html',
  styleUrls: ['./cover.component.css']
})
export class CoverComponent implements OnInit {
  photoCover!:Array<Covers>

  constructor() { }

  ngOnInit(): void {
    this.mount(dataBase)
  }

  mount(dataBase:Database):void{
    this.photoCover = dataBase.about.photoCover
  }

}
